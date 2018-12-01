<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 19:12
 */

namespace App\Services;


use App\Exceptions\IsPrizeNotConvertableException;
use Auth;

class User
{
    /** @var Auth */
    private $auth;

    /**
     * @param Auth $auth
     */
    public function setAuth(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @return Auth
     */
    public function getAuth(): Auth
    {
        return $this->auth??app('Auth');
    }

    /**
     * @return int
     * @throws AuthorizationException
     */
    protected function getCurrentUser()
    {
        $auth = $this->getAuth();
        $user = $auth::user();

        if($user === null){
            throw new AuthorizationException('Something wrong! No authorization user!');
        }

        return $user->id;
    }

    /**
     * Get won prize
     */
    public function getPrize(Prize $prize)
    {
        $prize->transfer($this->getCurrentUser());
    }

    /**
     * Refuse won prize
     */
    public function refusePrize(Prize $prize)
    {
        $prize->refuse($this->getCurrentUser());
    }

    /**
     * Get user's account by Account type and user id
     * @param AccountType $accountType
     * @param int $userId
     */
    public function getAccount(AccountType $accountType, int $userId)
    {

    }

    /**
     * Convert prize to another type of prize. If it convertable
     * @param MoneyPrize $prize
     * @return BonusPrize
     * @throws IsPrizeNotConvertableException
     * @throws \App\Exceptions\AccountNotExistsException
     * @throws \ReflectionException
     * @throws \Throwable
     */
    public function convertPrize(MoneyPrize $prize):BonusPrize
    {
        if($prize->isConvertable() === false){
            throw new IsPrizeNotConvertableException('You are tring to convert not convertable prize!');
        }

        return $prize->convert($this->getCurrentUser());
    }

    /**
     * withdraw from Money Account
     */
    public function withdraw()
    {

    }

    /**
     * @todo only for Admin
     */
    public function approvePrize()
    {

    }



}