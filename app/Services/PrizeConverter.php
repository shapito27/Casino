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
    /** @var int */
    private $exchangeRateValue;
    /** @var ConvertationTransfer */
    private $convertationTransfer;
    /** @var BonusPrize */
    private $convertTo;

    /**
     * @return BonusPrize
     */
    public function convert():BonusPrize
    {
        $bonusPrizeValue = $this->recountValueByRate($this->convertationTransfer->getValue());
        $this->convertationTransfer->setConvertedValue($bonusPrizeValue);
        $this->convertTo->setValue($bonusPrizeValue);

        if ($this->convertationTransfer->run()) {
            return $this->getConvertTo();
        }
    }

    /**
     * @param int $exchangeRateValue
     */
    public function setExchangeRateValue(int $exchangeRateValue): void
    {
        $this->exchangeRateValue = $exchangeRateValue;
    }

    /**
     * @param mixed $convertationTransfer
     */
    public function setConvertationTransfer(ConvertationTransfer $convertationTransfer): void
    {
        $this->convertationTransfer = $convertationTransfer;
    }

    /**
     * Convert money to bonus. money * excnageRate = bonuses
     * @param int $value
     * @return float
     */
    public function recountValueByRate(int $value):float
    {
        return $value * $this->exchangeRateValue;
    }

    /**
     * @param BonusPrize $convertToEntity
     */
    public function setConvertTo(BonusPrize $convertToEntity): void
    {
        $this->convertTo = $convertToEntity;
    }

    /**
     * @return BonusPrize
     */
    public function getConvertTo(): BonusPrize
    {
        return $this->convertTo;
    }
}