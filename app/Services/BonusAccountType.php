<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 19:55
 */

namespace App\Services;


class BonusAccountType extends AccountType
{
    public function getSystemAccountId():int
    {
        return (int)env('SYSTEM_BONUS_ACCOUNT');
    }
}