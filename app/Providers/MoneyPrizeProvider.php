<?php

namespace App\Providers;

use App\Services\MoneyPrize;
use Illuminate\Support\ServiceProvider;

class MoneyPrizeProvider extends ServiceProvider
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
        $this->app->bind('money.prize', function ($app) {
            return new MoneyPrize();
        });
    }
}
