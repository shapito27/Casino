<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 23.11.2018
 * Time: 23:52
 */

namespace App\Services;

use App\Models\Account as ModelAccount;

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
        if($accauntExisted !== null){
            return $accauntExisted;
        }

        $newAccount = new ModelAccount();
        $newAccount->type = $accountType->getClassName();
        $newAccount->user_id = $userId;
        $newAccount->saveOrFail();

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

//    protected function getSystemAccount(AccountType $accountType)
//    {
////        ConfigHelper::setEnvironmentValue('SYSTEM_MONEY_ACCOUNT', $moneyAccount->id);
//        env('SYSTEM_MONEY_ACCOUNT');
//        env('SYSTEM_BONUS_ACCOUNT');
//        env('SYSTEM_SUBJECT_ACCOUNT');
//        switch (instant $accountType)
//
//        return $systemAccountId;
//    }

}