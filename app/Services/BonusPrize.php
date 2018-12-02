<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 19:50
 */

namespace App\Services;



class BonusPrize extends Prize
{
    /** @var string  */
    protected $type = parent::BONUS;

    public function __construct()
    {
        $moneyInterval = (new PrizeInterval($this::getClassName()))->findIntervalByPrizeType();
        $this->setValue(random_int($moneyInterval->getFrom(), $moneyInterval->getTo()));
    }
}