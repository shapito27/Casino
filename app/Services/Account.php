<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 23.11.2018
 * Time: 23:52
 */

namespace App\Services;

use App\Exceptions\AccountBalanceHistoryNotFoundException;
use App\Exceptions\BalanceNotExistsException;
use App\Exceptions\NotDefinedOperationTypeException;
use App\Exceptions\NotSetedAccountIdException;
use App\Exceptions\SystemAccountNotFoundException;
use App\Models\Account as ModelAccount;
use App\Models\AccountBalanceHistory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

/**
 * Class Account
 * @package App\Services
 */
abstract class Account
{
    /** @var int  */
    private $accountId;
    /** @var ModelAccount */
    protected $model;
    /** @var AccountBalanceHistory */
    protected $accountBalanceHistory;
    /** @var int  */
    private $accountTypeBalanceDefaultValue = 0;
    /** @var string  */
    public const ACCOUNT_SUFIX = 'account';

    /**
     * @param \App\Models\Account $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * @return ModelAccount
     */
    public function getModel(): ModelAccount
    {
        return $this->model;
    }

    /**
     * @param int $accountId
     */
    public function setAccountId(int $accountId): void
    {
        $this->accountId = $accountId;
    }

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        if($this->accountId === null){
            throw new NotSetedAccountIdException();
        }

        return $this->accountId;
    }

    /**
     * @param AccountBalanceHistory $accountBalanceHistory
     */
    public function setAccountBalanceHistory(AccountBalanceHistory $accountBalanceHistory): void
    {
        $this->accountBalanceHistory = $accountBalanceHistory;
    }

    /**
     * @return AccountBalanceHistory
     */
    public function getAccountBalanceHistory(): AccountBalanceHistory
    {
        if ($this->accountBalanceHistory === null) {
            $this->setAccountBalanceHistory(app('App\Models\AccountBalanceHistory'));
        }

        return $this->accountBalanceHistory;
    }

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
    public static function getNamespace()
    {
        return __NAMESPACE__;
    }

    /**
     * Create account using received type
     *
     * @param Account $accountType
     * @param int $userId
     * @return ModelAccount
     * @throws \Throwable
     */
    public function create(int $userId): ModelAccount
    {
        $accauntExisted = $this->findAccountByUserId($userId);
        if ($accauntExisted !== null) {
            return $accauntExisted;
        }

        $newAccount = $this->getModel();
        $newAccount->type = $this->getClassName();
        $newAccount->user_id = $userId;
        $newAccount->saveOrFail();

        //delegate preparing balance value to specific Account entity
        $initValue = $this->prepareInitBalanceValue();
        $this->setBalance((int)$newAccount->id, $initValue);

        return $newAccount;
    }

    /**
     * Find Account by user id and type
     * @param int $userId
     * @return ModelAccount
     */
    public function findAccountByUserId(int $userId): ?ModelAccount
    {
        $account = ModelAccount::where([
            ['type', '=', $this->getClassName()],
            ['user_id', '=', $userId]
        ])->first();

        return $account??null;
    }

    /**
     * @param int $accountId
     * @param $value
     */
    protected function setBalance(int $accountId, $value):void
    {
        $newCurrentBalance = $this->getAccountBalanceHistory();
        $newCurrentBalance->account_id = $accountId;
        $newCurrentBalance->value = $value;
        $newCurrentBalance->saveOrFail();
    }

    /**
     * @param int $accountId
     * @param int $value
     * @param int $type debit|credit
     */
    public function updateBalance(int $value, int $type): void
    {
        $accountId = $this->getAccountId();
        $newValue = null;

        try {
            $this->getModel()::findOrFail($accountId);
        } catch (ModelNotFoundException $exception) {
            Log::critical($exception);
            throw new BalanceNotExistsException();
        }

        //delegate preparing balance value to specific Account entity
        $newValue = $this->prepareBalanceValue($accountId, $value, $type);

        $this->setBalance($accountId, $newValue);
    }

    /**
     * @param int $accountId
     * @return AccountBalanceHistory|\Illuminate\Database\Eloquent\Model
     */
    public function getBalance(int $accountId)
    {
        try{
            $currentBalance = $this->getAccountBalanceHistory()::where('account_id', $accountId)
                ->latest('id')
                ->firstOrFail();

            return $currentBalance;
        }catch (ModelNotFoundException $exception){
            Log::critical('AccountBalanceHistory not found!');
            throw new AccountBalanceHistoryNotFoundException();
        }
    }


    final public function refuse(Prize $prize, int $userId)
    {
        $userAccount = $this->findAccountByUserId( $userId);
        $operation = new Operation();

        $result = $operation->setSenderAccount($userAccount->id)
            ->setReceiverAccount($this->getSystemAccountId())
            ->setValue($prize->getValue())
            ->setType(Operation::OPERATION_TYPE_REFUSE)
            ->setStatus(Operation::OPERATION_TSTATUS_OK)
            ->transfer();
    }

    /**
     * @return int
     * @throws SystemAccountNotFoundException
     */
    public function getSystemAccountId():int
    {
        /** @var User $user */
        $user = app('user');
        $systemUserId = $user->getSystemUserId();

        $systemAccount = $this->findAccountByUserId($systemUserId);
        if ($systemAccount === null) {
            throw new SystemAccountNotFoundException();
        }

        return $systemAccount->id;
    }

    /**
     * @param int $value
     * @return mixed
     */
    abstract public function checkAccountBalanceHasEnough(int $value);

    /**
     * @param int $accountId
     * @param int $value
     * @param int $type
     * @throws NotDefinedOperationTypeException
     */
    public function prepareBalanceValue(int $accountId, int $value, int $type)
    {
        $newValue = null;
        $currentBalance = $this->getBalanceValue($accountId);

        switch ($type) {
            case Transfer::DEBET:
                $newValue = $currentBalance + $value;
                break;
            case Transfer::CREDIT:
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
    public function prepareInitBalanceValue()
    {
        return $this->accountTypeBalanceDefaultValue;
    }

    /**
     * @param int $accountId
     * @return int
     */
    public function getBalanceValue(int $accountId)
    {
        return (int)$this->getBalance($accountId)->value;
    }

    /**
     * @return string
     */
    public function getWinStatus()
    {
        return Transfer::OPERATION_STATUS_OK;
    }
}