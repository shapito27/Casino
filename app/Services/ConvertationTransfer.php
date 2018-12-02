<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 1.12.2018
 * Time: 10:36
 */

namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Class ConvertationTransfer need for transfer value from user1 account1 to  user1 account2
 * @package App\Services
 */
class ConvertationTransfer extends AbstractTransfer
{
    /** @var int */
    private $convertedValue;

    public function run()
    {
        $this->setSenderAccountId($this->senderAccount->getAccountId());
        $this->setReceiverAccountId($this->receiverAccount->getAccountId());
        $this->senderAccount->checkAccountBalanceHasEnough($this->getValue());

        // save operation and updates balances in one transaction
        DB::transaction(function (){
            //@todo помечаем предыдущую операцию выйгрыша денег как ок вместо ожидания
            // save operation
            $this->save();
            //@todo блокировать баланс (строку) админа пока идет обновление
            //обновление баланса аккаунта 1
            $this->senderAccount->updateBalance( $this->getValue(), self::CREDIT);
            //обновление баланса аккаунта 2
            $this->receiverAccount->updateBalance($this->getConvertedValue(), self::DEBET);
        }, 3);

        if($this->getId() !== null){
            return true;
        }

        return false;
    }

    /**
     * @param int $convertedValue
     */
    public function setConvertedValue(int $convertedValue): void
    {
        $this->convertedValue = $convertedValue;
    }

    /**
     * @return int
     */
    public function getConvertedValue(): int
    {
        return $this->convertedValue;
    }
}