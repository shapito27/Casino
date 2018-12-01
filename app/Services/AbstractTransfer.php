<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 1.12.2018
 * Time: 10:35
 */

namespace App\Services;


abstract class AbstractTransfer
{
    protected $accountSender;
    protected $accountReceiver;

    public function run()
    {

    }

    public function setModel(\App\Models\Operation $operation)
    {

    }
}