<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 21:45
 */

namespace App\Services;


use Illuminate\Support\Facades\DB;

class Operation
{
    protected $model;

    const OPERATION_TYPE_WIN = 'Выйгрыш';
    const OPERATION_TYPE_REFUSE = 'Отказ';

    const OPERATION_TSTATUS_WAIT = 'Ожидание';
    const OPERATION_TSTATUS_OK = 'Завершено успешно';

    const DEBET = 1;
    const CREDIT = 0;

    public function __construct()
    {
        $this->model = new \App\Models\Operation();
    }

    /**
     * @param int $senderAccountId
     * @return $this
     */
    public function setSenderAccount(int $senderAccountId)
    {
        $this->model->sender_account_id = $senderAccountId;

        return $this;
    }

    /**
     * @param int $receiverAccountId
     * @return $this
     */
    public function setReceiverAccount(int $receiverAccountId)
    {
        $this->model->receiver_account_id = $receiverAccountId;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setValue(int $value)
    {
        $this->model->value = $value;

        return $this;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type)
    {
        $this->model->type = $type;

        return $this;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status)
    {
        $this->model->status = $status;

        return $this;
    }

    /**
     * @return bool
     * @throws \App\Exceptions\AccountNotExistsException
     * @throws \Throwable
     */
    public function transfer():bool
    {
        /**
         * @todo Обновление статуса проводки на ok  ????
         * */
        //Получаем баланс. Проверяем, что баланс отправителя достаточный.
        Account::checkAccountBalanceHasEnough($this->model->sender_account_id, $this->model->value);

        // save operation and updates balances in one transaction
        DB::transaction(function () {
            // save operation
            $this->model->save();
            //@todo блокировать баланс (строку) админа пока идет обновление
            //обновление баланса аккаунта 1
            Account::updateBalance($this->model->sender_account_id, $this->model->value, self::CREDIT);
            //обновление баланса аккаунта 2
            Account::updateBalance($this->model->receiver_account_id, $this->model->value, self::DEBET);
        }, 3);

        if($this->model->id !== null){
            return true;
        }

        return false;
    }

    /**
     * For convertation one more transfer because debit for first account and credit for second accaunt not equal
     * @param int $value
     * @param int $convertedValue
     * @return bool
     * @throws \Throwable
     */
    public function convertationTransfer(int $value, int $convertedValue):bool
    {
        $this->setValue($value);
        // save operation and updates balances in one transaction
        DB::transaction(function () use ($value, $convertedValue) {
            // save operation
            $this->model->save();
            //@todo блокировать баланс (строку) админа пока идет обновление
            //обновление баланса аккаунта 1
            Account::updateBalance($this->model->sender_account_id, $value, self::CREDIT);
            //обновление баланса аккаунта 2
            Account::updateBalance($this->model->receiver_account_id, $convertedValue, self::DEBET);
        }, 3);

        if($this->model->id !== null){
            return true;
        }

        return false;
    }
}