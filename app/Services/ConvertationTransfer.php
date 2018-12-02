<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 1.12.2018
 * Time: 10:36
 */

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        //check that we have enough for transfer
        $this->senderAccount->checkAccountBalanceHasEnough($this->getValue());

        // save operation and updates balances in one transaction
        DB::transaction(function (){
            // save operation
            $this->save();
            //@todo lock admin's balance(row) while update is going
            //обновление баланса аккаунта 1
            $this->senderAccount->updateBalance( $this->getValue(), self::CREDIT, $this->getId());
            //обновление баланса аккаунта 2
            $this->receiverAccount->updateBalance($this->getConvertedValue(), self::DEBET, $this->getId());
            //update previous operation before Convertation, when user won
            $this->updatePreviousOperation();
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

    /**
     * @return bool
     * @throws \App\Exceptions\NotSetedAccountIdException
     */
    public function updatePreviousOperation(): bool
    {
        /** @var \App\Models\Operation $previousOperationModel */
        $previousOperationModel = $this->getModel();

        // find previous operation by value and receiver_account_id
        $previousOperation = $previousOperationModel::where([
            ['value', $this->getValue()],
            ['receiver_account_id', $this->senderAccount->getAccountId()],
        ])->latest()->first();

        if($previousOperation === null){
            Log::critical('After convertation failed to change previous operation status!');
        }

        $previousOperation->update(['status' => self::OPERATION_STATUS_OK]);

        return true;
    }
}