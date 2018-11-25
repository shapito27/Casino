<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 18:27
 */

namespace App\Services;


use App\Exceptions\NotEnoughMoneyOnBalanceException;

class MoneyAccountType extends AccountType
{
    public static function notEnoughBalance()
    {
        throw new NotEnoughMoneyOnBalanceException();
    }

    public static function checkAccountBalanceHasEnough(int $accountId, int $value)
    {
        //если это админский то можно в минус
        if($accountId === (new self)->getSystemAccountId()){
            return true;
        }

        $currentBalance = self::getBalanceValue($accountId);

        if($currentBalance < $value){
            throw new NotEnoughMoneyOnBalanceException();
        }

        return true;
    }
}