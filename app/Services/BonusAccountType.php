<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 19:55
 */

namespace App\Services;


use Illuminate\Support\Facades\Log;

class BonusAccountType extends AccountType
{
    public static function notEnoughBalance()
    {
    }

    public static function checkAccountBalanceHasEnough(int $accountId, int $value)
    {
        return true;
    }
}