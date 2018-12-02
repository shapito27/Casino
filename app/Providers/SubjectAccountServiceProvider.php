<?php

namespace App\Providers;

use App\Services\SubjectAccount;
use Illuminate\Support\ServiceProvider;

class SubjectAccountServiceProvider extends ServiceProvider
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
        $this->app->bind('subject.account', function () {
            $subjectAccount = new SubjectAccount();
            $subjectAccount->setModel($this->app->make('App\Models\Account'));

            return $subjectAccount;
        });
    }
}
