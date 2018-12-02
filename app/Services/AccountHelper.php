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
     * Have to return string like 'money.account' . It's Facade
     * @param Prize $prize
     * @return string
     */
    public function getAccountTypeByPrize(Prize $prize)
    {
        return $prize->getType() . '.' . Account::ACCOUNT_SUFFIX;
    }

    /**
     * Get specific account by account id
     * @param int $accountId
     * @return Account
     */
    public function getAccoutntByAccountId(int $accountId):Account
    {
        $accountModel = $this->getAccountModel()::where('id', $accountId)->first();
        /** @var Account $account */
        $account = app($this->getAccountFacadeName($accountModel->type));
        $account->setAccountId($accountId);

        return $account;
    }

    /**
     * @param $accountClassName
     * @return string
     */
    public function getAccountFacadeName($accountClassName)
    {
        return str_replace([Account::ACCOUNT_SUFFIX, strtolower(self::getNamespace()) . '\\'], '',
                strtolower($accountClassName)) . '.' . Account::ACCOUNT_SUFFIX;
    }

    /**
     * Get class namespace
     * @return string
     */
    public static function getNamespace()
    {
        return __NAMESPACE__;
    }
}