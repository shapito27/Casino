<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 19:12
 */

namespace App\Services;


use App\Exceptions\IsPrizeConvertableException;

class User
{
    /**
     * @return int
     * @throws AuthorizationException
     */
    protected function getCurrentUser()
    {
        $user = \Auth::user();
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
     */
    public function convertPrize(Prize $prize)
    {
        if($prize->isConvertable() === false){
            throw new IsPrizeConvertableException();
        }

        $prize->convert($this);
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