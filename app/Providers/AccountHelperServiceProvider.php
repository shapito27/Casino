<?php

namespace App\Providers;

use App\Services\AccountHelper;
use Illuminate\Support\ServiceProvider;

class AccountHelperServiceProvider extends ServiceProvider
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
        $this->app->bind('account.helper', function () {

            return new AccountHelper();
        });
    }
}
