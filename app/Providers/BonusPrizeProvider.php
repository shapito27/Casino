<?php

namespace App\Providers;

use App\Services\BonusPrize;
use Illuminate\Support\ServiceProvider;

class BonusPrizeProvider extends ServiceProvider
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
            return new BonusPrize();
        });
    }
}
