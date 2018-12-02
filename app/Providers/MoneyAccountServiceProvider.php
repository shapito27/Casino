<?php

namespace App\Providers;

use App\Models\Account;
use App\Services\MoneyAccount;
use Illuminate\Support\ServiceProvider;

class MoneyAccountServiceProvider extends ServiceProvider
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
        $this->app->bind('money.account', function () {
            $moneyAccount = new MoneyAccount();
            $moneyAccount->setModel($this->app->make('App\Models\Account'));

            return $moneyAccount;
        });
    }
}
