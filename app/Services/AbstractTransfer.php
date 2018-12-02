<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 1.12.2018
 * Time: 10:35
 */

namespace App\Services;


abstract class AbstractTransfer
{
    /** @var  */
    protected $value;

    /** @var \App\Models\Operation */
    protected $model;

    /** @var Account */
    protected $senderAccount;

    /** @var Account */
    protected $receiverAccount;

    const OPERATION_TYPE_WIN = 'Выйгрыш';
    const OPERATION_TYPE_REFUSE = 'Отказ';
    const OPERATION_TYPE_CONVERTATION = 'Конвертация';

    const OPERATION_STATUS_WAIT = 'Ожидание';
    const OPERATION_STATUS_OK = 'Завершено успешно';

    const DEBET = 1;
    const CREDIT = 0;

    abstract public function run();

    /**
     * @param \App\Models\Operation $operation
     */
    public function setModel(\App\Models\Operation $operation)
    {
        $this->model = $operation;
    }

    /**
     * @return \App\Models\Operation
     */
    public function getModel(): \App\Models\Operation
    {
        if ($this->model === null) {
            return app('App\Models\Operation');
        }

        return $this->model;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->model->status = $status;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->model->type = $type;
    }


    /**
     * @param Account $receiverAccount
     */
    public function setReceiverAccount(Account $receiverAccount): void
    {
        $this->receiverAccount = $receiverAccount;
    }

    /**
     * @param mixed $receiverAccount
     */
    public function setReceiverAccountId(int $receiverAccount): void
    {
        $this->model->receiver_account_id = $receiverAccount;
    }

    /**
     * @param mixed $senderAccount
     */
    public function setSenderAccountId(int $senderAccount): void
    {
        $this->model->sender_account_id = $senderAccount;
    }

    /**
     * @param Account $senderAccount
     */
    public function setSenderAccount(Account $senderAccount): void
    {
        $this->senderAccount = $senderAccount;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->model->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->model->value;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->model->id;
    }

    /**
     *
     */
    protected function save():void
    {
        $this->model->save();
    }
}