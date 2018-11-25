<?php

namespace App\Services;


use function Psy\debug;

abstract class AccountType
{
    /** @var string  */
    public const ACCOUNT_TYPE_SUFIX = 'AccountType';

    /**
     * @return string
     */
    public function getClassName()
    {
        return static::class;
    }

    /**
     * Get class namespace
     * @return string
     */
    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    /**
     * @param Prize $prize
     * @param int $userId
     */
    public function transfer(Prize $prize, int $userId)
    {
        $userAccount = Account::findByTypeAndUserId($this, $userId);
        $operation = new Operation();
        debug($this);
        log($this->getSystemAccountId());
        $operation->setSenderAccount($this->getSystemAccountId())
            ->setReceiverAccount($userAccount->id)
            ->setValue($prize->value)
            ->setType(Operation::OPERATION_TYPE_WIN)
            ->setStatus(Operation::OPERATION_TSTATUS_WAIT)
            ->transfer();
    }

    /**
     * @return int
     */
    abstract public function getSystemAccountId():int;
}