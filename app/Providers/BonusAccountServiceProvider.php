<?php

namespace App\Providers;

use App\Services\BonusAccount;
use Illuminate\Support\ServiceProvider;

class BonusAccountServiceProvider extends ServiceProvider
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
        $this->app->bind('bonus.account', function () {
            $bonusAccount = new BonusAccount();
            $bonusAccount->setModel($this->app->make('App\Models\Account'));

            return $bonusAccount;
        });
    }
}
