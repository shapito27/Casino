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

    public function setSenderAccount(int $senderAccountId)
    {
        $this->model->sender_account_id = $senderAccountId;

        return $this;
    }

    public function setReceiverAccount(int $receiverAccountId)
    {
        $this->model->receiver_account_id = $receiverAccountId;

        return $this;
    }

    public function setValue(int $value)
    {
        $this->model->value = $value;

        return $this;
    }

    public function setType(string $type)
    {
        $this->model->type = $type;

        return $this;
    }

    public function setStatus(string $status)
    {
        $this->model->status = $status;

        return $this;
    }

    public function transfer()
    {
        /**
         * @todo
         * 1. Сохранение проводки В Транзакцию!
         *
         *
         * 4                        Обновление статуса проводки на ok ????
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
        });
    }
}