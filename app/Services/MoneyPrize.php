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
 * @property MoneyAccountType $accountType
 * @package App\Services
 */
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
     * @param int $userId
     * @return BonusPrize
     * @throws \App\Exceptions\AccountNotExistsException
     * @throws \Throwable
     */
    public function convert(int $userId):BonusPrize
    {
        return $this->accountType->convert($this, $userId);
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