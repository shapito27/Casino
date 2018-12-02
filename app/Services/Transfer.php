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
 * Class Transfer need for transfer value from user1 account to  user2 account
 * @package App\Services
 */
class Transfer extends AbstractTransfer
{
    public function run()
    {
        $this->setSenderAccountId($this->senderAccount->getAccountId());
        $this->setReceiverAccountId($this->receiverAccount->getAccountId());

        $this->senderAccount->checkAccountBalanceHasEnough($this->getValue());

        // save operation and updates balances in one transaction
        DB::transaction(function (){
            // save operation
            $this->save();
            //@todo блокировать баланс (строку) админа пока идет обновление
            //обновление баланса аккаунта 1
            $this->senderAccount->updateBalance( $this->getValue(), self::CREDIT, $this->getId());
            //обновление баланса аккаунта 2
            $this->receiverAccount->updateBalance($this->getValue(), self::DEBET, $this->getId());
        }, 3);

        if($this->getId() !== null){
            return true;
        }

        return false;
    }

    // найти опеации в ожидании
    // обновить их статусы
    // обновить баланс аккаунтов
    public function findWaitedOperations($limit)
    {
        $operationModel = $this->getModel();
        $operationModel::where('status', self::OPERATION_STATUS_WAIT)
            ->latest()
            ->take($limit)
            ->update(['status' => self::OPERATION_STATUS_OK]);

    }
}