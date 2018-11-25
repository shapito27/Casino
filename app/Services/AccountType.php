<?php

namespace App\Services;


use App\Exceptions\AccountNotFoundException;
use app\Exceptions\NotDefinedOperationTypeException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use function Psy\debug;

abstract class AccountType
{
    private static $accountTypeBalanceDefaultValue = 0;

    /** @var string  */
    public const ACCOUNT_TYPE_SUFIX = 'AccountType';

    /**
     * @return string
     */
    public function getClassName():string
    {
        return static::class;
    }

    /**
     * Get class namespace
     * @return string
     */
    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    /**
     * @param Prize $prize
     * @param int $userId
     */
    final public function transfer(Prize $prize, int $userId)
    {
        $userAccount = Account::findByTypeAndUserId($this, $userId);
        $operation = new Operation();

        $result = $operation->setSenderAccount($this->getSystemAccountId())
            ->setReceiverAccount($userAccount->id)
            ->setValue($prize->value)
            ->setType(Operation::OPERATION_TYPE_WIN)
            ->setStatus(Operation::OPERATION_TSTATUS_WAIT)
            ->transfer();

        // save prize in session for simple refuse
        if($result === true){
            //save last operation to session
            session([Prize::SESSION_VAR_LAST_GOTTENN_PRIZE => $prize]);
        }
    }

    final public function refuse(Prize $prize, int $userId)
    {
        $userAccount = Account::findByTypeAndUserId($this, $userId);
        $operation = new Operation();

        $result = $operation->setSenderAccount($userAccount->id)
            ->setReceiverAccount($this->getSystemAccountId())
            ->setValue($prize->value)
            ->setType(Operation::OPERATION_TYPE_REFUSE)
            ->setStatus(Operation::OPERATION_TSTATUS_OK)
            ->transfer();
    }

    /**
     * @return int
     */
    public function getSystemAccountId():int
    {
        try{
            $systemUser = \App\Models\User::withRole('Admin')->firstOrFail();
        }catch (ModelNotFoundException $exception){
            Log::critical('Admin Account not found!');
            throw new AccountNotFoundException();
        }

        return Account::findByTypeAndUserId($this, $systemUser->id)->id;
    }

    abstract public static function notEnoughBalance();

    abstract public static function checkAccountBalanceHasEnough(int $accountId, int $value);

    /**
     * @param int $accountId
     * @param int $value
     * @param int $type
     * @throws NotDefinedOperationTypeException
     */
    public static function prepareBalanceValue(int $accountId, int $value, int $type)
    {
        $newValue = null;
        $currentBalance = self::getBalanceValue($accountId);

        switch ($type) {
            case Operation::DEBET:
                $newValue = $currentBalance + $value;
                break;
            case Operation::CREDIT:
                $newValue = $currentBalance - $value;
                break;
            default:
                throw new NotDefinedOperationTypeException();
        }

        return $newValue;
    }

    /**
     * @param $value
     * @return int|string
     */
    public static function prepareInitBalanceValue()
    {
        return self::$accountTypeBalanceDefaultValue;
    }

    /**
     * @param int $accountId
     * @return int
     */
    public static function getBalanceValue(int $accountId)
    {
        return (int)Account::getBalance($accountId)->value;
    }
}