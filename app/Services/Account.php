<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 23.11.2018
 * Time: 23:52
 */

namespace App\Services;

use App\Exceptions\AccountBalanceHistoryNotFoundException;
use App\Exceptions\AccountNotExistsException;
use App\Exceptions\BalanceNotExistsException;
use App\Models\Account as ModelAccount;
use App\Models\AccountBalanceHistory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

/**
 * Class Account
 * @package App\Services
 */
class Account
{
    /**
     * Create account using received type
     *
     * @param AccountType $accountType
     * @param int $userId
     * @return ModelAccount
     * @throws \Throwable
     */
    public static function create(AccountType $accountType, int $userId): ModelAccount
    {
        $accauntExisted = self::findByTypeAndUserId($accountType, $userId);
        if ($accauntExisted !== null) {
            return $accauntExisted;
        }

        $newAccount = new ModelAccount();
        $newAccount->type = $accountType->getClassName();
        $newAccount->user_id = $userId;
        $newAccount->saveOrFail();

        /** @var AccountType $accountType */
        $accountType = new $newAccount->type;
        //delegate preparing balance value to specific AccountType entity
        $initValue = $accountType::prepareInitBalanceValue();
        self::setBalance((int)$newAccount->id, $initValue);

        return $newAccount;
    }

    /**
     * Find Account by type and user id
     * @param AccountType $accountType
     * @param int $userId
     * @return ModelAccount
     */
    public static function findByTypeAndUserId(AccountType $accountType, int $userId):?ModelAccount
    {
        return ModelAccount::where([
            ['type', '=', $accountType->getClassName()],
            ['user_id', '=', $userId]
        ])->first();
    }

    /**
     * @param int $accountId
     * @param $value
     */
    protected static function setBalance(int $accountId, $value):void
    {
        $newCurrentBalance = new AccountBalanceHistory();
        $newCurrentBalance->account_id = $accountId;
        $newCurrentBalance->value = $value;
        $newCurrentBalance->save();
    }

    /**
     * @param int $accountId
     * @param int $value
     * @param int $type debit|credit
     */
    public static function updateBalance(int $accountId, int $value, int $type):void
    {
        $newValue = null;

        try {
            $currentAccount = \App\Models\Account::findOrFail($accountId);
        } catch (ModelNotFoundException $exception) {
            Log::critical($exception);
            throw new BalanceNotExistsException();
        }

        /** @var AccountType $accountType */
        $accountType = new $currentAccount->type;

        //delegate preparing balance value to specific AccountType entity
        $newValue = $accountType::prepareBalanceValue($accountId, $value, $type);

        self::setBalance($accountId, $newValue);
    }

    /**
     * @param int $accountId
     * @return AccountBalanceHistory|\Illuminate\Database\Eloquent\Model
     */
    public static function getBalance(int $accountId)
    {
        try{
            $currentBalance = AccountBalanceHistory::where('account_id', '=', $accountId)->orderBy('id', 'desc')->firstOrFail();

            return $currentBalance;
        }catch (ModelNotFoundException $exception){
            Log::critical('AccountBalanceHistory not found!');
            throw new AccountBalanceHistoryNotFoundException();
        }
    }

    /**
     * @param int $accountId
     * @param $value prize value which we want to transfer
     */
    public static function checkAccountBalanceHasEnough(int $accountId, $value)
    {
        try {
            $currentAccount = \App\Models\Account::findOrFail($accountId);
        } catch (ModelNotFoundException $exception) {
            Log::critical($exception);
            throw new AccountNotExistsException();
        }

        /** @var AccountType $accountType */
        $accountType = new $currentAccount->type;

        return $accountType::checkAccountBalanceHasEnough($accountId, $value);
    }
}