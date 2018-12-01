<?php

namespace App\Providers;

use App\Services\SubjectPrize;
use Illuminate\Support\ServiceProvider;

class SubjectPrizeProvider extends ServiceProvider
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
            return new SubjectPrize();
        });
    }
}
