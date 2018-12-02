<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 19:55
 */

namespace App\Services;


use Illuminate\Support\Facades\Log;

class BonusAccount extends Account
{
    public static function notEnoughBalance()
    {
    }

    /**
     * @param int $value
     * @return bool|mixed
     */
    public function checkAccountBalanceHasEnough(int $value)
    {
        return true;
    }
}