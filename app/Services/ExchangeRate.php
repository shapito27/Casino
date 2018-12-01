<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 23:02
 */

namespace App\Services;


use App\ConfigHelper;

class ExchangeRate
{
    const EXCHANGE_RATE_COEFFICIENT_NAME = 'EXCHANGE_RATE_COEFFICIENT';

    /**
     * @return int
     */
    public function getRate():int
    {
        return config('casino.exchange_rate_coefficient');
    }

    /**
     * @todo работает?
     * @param $value
     */
    public function setRate(int $value)
    {
        ConfigHelper::setEnvironmentValue(self::EXCHANGE_RATE_COEFFICIENT_NAME, $value);

        throw new \InvalidArgumentException('Not correct type for exchange rate');
    }
}