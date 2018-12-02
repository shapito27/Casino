<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 1.12.2018
 * Time: 10:40
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class BonusAccount extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bonus.account';
    }
}