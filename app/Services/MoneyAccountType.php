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

    /**
     * @param Prize $prize
     * @param int $userId
     * @return BonusPrize
     * @throws \App\Exceptions\AccountNotExistsException
     * @throws \Throwable
     */
    public function convert(Prize $prize, int $userId):BonusPrize
    {
        $exchangeRate = (new ExchangeRate())->getRate();

        /** @var BonusPrize $newPrize */
        $newPrize = new BonusPrize();
        //set converted value
        $newPrize->setValue($this->recountByRate($prize->value, $exchangeRate));

        $userMoneyAccount = Account::findByTypeAndUserId($this, $userId);
        $userBonusAccount = Account::findByTypeAndUserId(new BonusAccountType(), $userId);
        $operation = new Operation();

        $operation->setSenderAccount($userMoneyAccount->id)
            ->setReceiverAccount($userBonusAccount->id)
            ->setType(Operation::OPERATION_TYPE_REFUSE)
            ->setStatus(Operation::OPERATION_TSTATUS_OK)
            ->convertationTransfer($prize->value, $newPrize->value);

        return $newPrize;
    }

    /**
     * Convert money to bonus. money * excnageRate = bonuses
     * @param int $value
     * @param int $exchangeRate
     * @return int
     */
    public function recountByRate(int $value, int $exchangeRate):float
    {
        return $value * $exchangeRate;
    }

}