<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 26.11.2018
 * Time: 2:02
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Transfer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'transfer';
    }
}