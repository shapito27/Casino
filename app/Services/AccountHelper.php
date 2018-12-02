<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 01.12.2018
 * Time: 19:03
 */

namespace App\Services;

class AccountHelper
{
    /** @var \App\Models\Account */
    private $account;

    /**
     * @param \App\Models\Account $account
     */
    public function setAccount(\App\Models\Account $account): void
    {
        $this->account = $account;
    }

    /**
     * @return \App\Models\Account
     */
    public function getAccountModel(): \App\Models\Account
    {
        if ($this->account === null) {
            $this->setAccount(app('App\Models\Account'));
        }

        return $this->account;
    }

    /**
     * Have to return string like 'App\Services\MoneyAccount'
     */
    public function getAccountTypeByPrize(Prize $prize)
    {
        return $prize->getType() . '.' . Account::ACCOUNT_SUFIX;
    }
}