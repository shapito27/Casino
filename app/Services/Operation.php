<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 21:45
 */

namespace App\Services;


class Operation
{
    protected $model;

    const OPERATION_TYPE_WIN = 'Выйгрыш';
    const OPERATION_TYPE_REFUSE = 'Отказ';

    const OPERATION_TSTATUS_WAIT = 'Ожидание';
    const OPERATION_TSTATUS_OK = 'Завершено успешно';

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
         * 0. Получаем балансы. Проверяем, что баланс отправителя достаточный.
         * 1. Сохранение проводки В Транзакцию!
         * 2. Создание задания на:  обновление баланса аккаунта 1
         * 3.                       обновление баланса аккаунта 2
         * 4                        Обновление статуса проводки на ok
         * */

        $this->model->save();
    }
}