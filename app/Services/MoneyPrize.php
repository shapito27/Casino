<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 18:39
 */

namespace App\Services;


use App\Contracts\Convertable;

/**
 * Class MoneyPrize
 * @property MoneyAccount $accountType
 * @package App\Services
 */
class MoneyPrize extends Prize implements Convertable
{

    /** @var PrizeConverter */
    protected $converter;

    /** @var string */
    protected $type = parent::MONEY;

    public function __construct()
    {
        $moneyInterval = (new PrizeInterval($this::getClassName()))->findIntervalByPrizeType();
        $this->setValue(random_int($moneyInterval->getFrom(), $moneyInterval->getTo()));
    }


    public function convert():BonusPrize
    {
        return $this->converter->convert();
    }

    /**
     * @param mixed $converter
     */
    public function setConverter($converter): void
    {
        $this->converter = $converter;
    }
}