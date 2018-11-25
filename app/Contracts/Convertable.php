<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 18:45
 */

namespace app\Contracts;


interface Convertable
{
    public function convert(int $userId);
}