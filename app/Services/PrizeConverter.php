<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 1.12.2018
 * Time: 10:32
 */

namespace App\Services;

/**
 * Class PrizeConverter
 * @package App\Services
 */
class PrizeConverter
{
    private $exchangeRate;
    private $convertationTransfer;

    public function convert(\App\Facades\MoneyPrize $moneyPrize)
    {
    }

    /**
     * @param mixed $exchangeRate
     */
    public function setExchangeRate(\App\Facades\ExchangeRate $exchangeRate): void
    {
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * @param mixed $convertationTransfer
     */
    public function setConvertationTransfer(ConvertationTransfer $convertationTransfer): void
    {
        $this->convertationTransfer = $convertationTransfer;
    }

}