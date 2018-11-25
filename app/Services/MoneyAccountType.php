<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 18:27
 */

namespace App\Services;


class MoneyAccountType extends AccountType
{
    /**
     * @return int
     */
    public function getSystemAccountId(): int
    {
        return (int)env('SYSTEM_MONEY_ACCOUNT');
    }
}