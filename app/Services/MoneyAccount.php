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
    public static function notEnoughBalance()
    {
        throw new NotEnoughMoneyOnBalanceException();
    }

    public function checkAccountBalanceHasEnough( int $value)
    {
        $accountId = $this->getAccountId();

        //если это админский то можно в минус
        if($accountId === $this->getSystemAccountId()){
            return true;
        }

        $currentBalance = $this->getBalanceValue($accountId);

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
        $newPrize->setValue($this->recountByRate($prize->getValue(), $exchangeRate));

        $userMoneyAccount = Account::findByTypeAndUserId($this->getClassName(), $userId);
        $userBonusAccount = Account::findByTypeAndUserId($newPrize->getAccountType(), $userId);
        $operation = new Operation();

        $operation->setSenderAccount($userMoneyAccount->id)
            ->setReceiverAccount($userBonusAccount->id)
            ->setType(Operation::OPERATION_TYPE_REFUSE)
            ->setStatus(Operation::OPERATION_TSTATUS_OK)
            ->convertationTransfer($prize->getValue(), $newPrize->getValue());

        return $newPrize;
    }



    public function getWinStatus()
    {
        return Transfer::OPERATION_STATUS_WAIT;
    }

}