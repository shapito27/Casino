<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 19:55
 */

namespace App\Services;


class BonusAccount extends Account
{
    /**
     * @param int $value
     * @return bool|mixed
     */
    public function checkAccountBalanceHasEnough(int $value)
    {
        return true;
    }
}