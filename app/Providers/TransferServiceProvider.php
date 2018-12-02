<?php

namespace App\Providers;

use App\Models\Operation;
use App\Services\Account;
use App\Services\Transfer;
use Illuminate\Support\ServiceProvider;

class TransferServiceProvider extends ServiceProvider
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
        $this->app->bind('transfer', function ($app) {
            $transfer = new Transfer();
            $transfer->setModel($this->app->make('App\Models\Operation'));

            return $transfer;
        });
    }
}
