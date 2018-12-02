<?php

namespace App\Providers;

use App\Services\PrizeTransmiter;
use Illuminate\Support\ServiceProvider;

class PrizeTransmiterServiceProvider extends ServiceProvider
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
        $this->app->bind('prize.transmiter', function ($app) {
            return new PrizeTransmiter();
        });
    }
}
