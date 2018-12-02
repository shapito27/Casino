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
        DB::transaction(function () {
            // save operation
            $this->save();
            //@todo блокировать баланс (строку) админа пока идет обновление

            //update account balance  1
            $this->senderAccount->updateBalance($this->getValue(), self::CREDIT, $this->getId());
            //update account balance  2
            $this->receiverAccount->updateBalance($this->getValue(), self::DEBET, $this->getId());
        }, 3);

        if ($this->getId() !== null) {
            return true;
        }

        return false;
    }

    /**
     * @param $limit
     * @return bool
     * @throws \App\Exceptions\BalanceNotExistsException
     * @throws \App\Exceptions\NotDefinedOperationTypeException
     * @throws \App\Exceptions\NotSetedAccountIdException
     * @throws \Throwable
     */
    public function approveWaitedOperations($limit)
    {
        $operationModel = $this->getModel();
        //find oldest operations which in status 'Ожидание'
        $operationModel::where('status', self::OPERATION_STATUS_WAIT)
            ->oldest()
            ->take($limit)
            ->update(['status' => self::OPERATION_STATUS_OK]);

        return true;
    }
}