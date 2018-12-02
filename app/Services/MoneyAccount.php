<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 18:27
 */

namespace App\Services;


use App\Exceptions\NotEnoughMoneyOnBalanceException;

class MoneyAccount extends Account
{
    /**
     * @throws NotEnoughMoneyOnBalanceException
     */
    public static function notEnoughBalance()
    {
        throw new NotEnoughMoneyOnBalanceException();
    }

    /**
     * @param int $value
     * @return bool|mixed
     * @throws NotEnoughMoneyOnBalanceException
     * @throws \App\Exceptions\AccountBalanceHistoryNotFoundException
     * @throws \App\Exceptions\NotSetedAccountIdException
     * @throws \App\Exceptions\SystemAccountNotFoundException
     */
    public function checkAccountBalanceHasEnough( int $value)
    {
        $accountId = $this->getAccountId();

        //id admin then can go down to minus
        if($accountId === $this->getSystemAccountId()){
            return true;
        }

        $currentBalance = $this->getBalanceValue($accountId);

        if($currentBalance < $value){
            throw new NotEnoughMoneyOnBalanceException();
        }

        return true;
    }
}