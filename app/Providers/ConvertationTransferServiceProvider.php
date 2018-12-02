<?php

namespace App\Providers;

use App\Services\ConvertationTransfer;
use Illuminate\Support\ServiceProvider;

class ConvertationTransferServiceProvider extends ServiceProvider
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
        $this->app->bind('convertation.transfer', function ($app) {
            $transfer = new ConvertationTransfer();
            $transfer->setModel($this->app->make('App\Models\Operation'));

            return $transfer;
        });
    }
}
