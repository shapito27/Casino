<?php

namespace App\Providers;

use App\Services\BonusPrize;
use App\Services\ExchangeRate;
use App\Services\PrizeConverter;
use Illuminate\Support\ServiceProvider;

class PrizeConverterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('prize.converter', function ($app) {
            /** @var ExchangeRate $exchangeRate */
            $exchangeRate = $this->app->make('exchange.rate');
            /** @var BonusPrize $bonusPrize */
            $bonusPrize = $this->app->make('bonus.prize');
            $prizeConverter = new PrizeConverter();
            $prizeConverter->setExchangeRateValue($exchangeRate->getRate());
            $prizeConverter->setConvertTo($bonusPrize);

            return $prizeConverter;
        });
    }
}
