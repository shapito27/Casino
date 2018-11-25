<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 18:39
 */

namespace App\Services;


use App\Contracts\Convertable;

class MoneyPrize extends Prize implements Convertable
{

    /** @var string */
    protected $type = parent::MONEY;

    public function __construct()
    {
        parent::__construct();

        $moneyInterval = (new PrizeInterval($this::getClassName()))->findIntervalByPrizeType();
        $this->setValue(random_int($moneyInterval->getFrom(), $moneyInterval->getTo()));
    }

    /**
     *
     */
    public function convert()
    {
        $this->accountType->convert();
    }

//    /**
//     * @return $this
//     * @throws \Exception
//     */
//    protected function create()
//    {
//        $moneyInterval = (new PrizeInterval($this))->findIntervalByPrizeType();
//        $this->setValue(random_int($moneyInterval->getFrom(), $moneyInterval->getTo()));
//
//        return $this;
//    }
}