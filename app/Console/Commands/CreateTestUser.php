<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\BonusAccount;
use App\Services\MoneyAccount;
use App\Services\SubjectAccount;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateTestUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'casino:createTestUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create test user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $password = 'ksd9f8asdksdf9';

        //Создаем проверяющего
        $user = new User();
        $user->name = 'TestUser';
        $user->password = Hash::make($password);
        $user->email = 'example2@test.ru';
        $user->save();
        $user->attachRole(\App\Models\Role::getUser());

        /**
         * Создаем  счета админа
         */

        //Создаем денежный счет админа
        /** @var MoneyAccount $moneyAccount */
        $moneyAccount = app('money.account');
        $moneyAccount->create($user->id);

        //Создаем бонусный счет админа
        /** @var BonusAccount $bonusAccount */
        $bonusAccount = app('bonus.account');
        $bonusAccount->create($user->id);

        //Создаем предметный счет админа
        /** @var SubjectAccount $subjectAccount */
        $subjectAccount = app('subject.account');
        $subjectAccount->create($user->id);

        echo "Success!\n";
    }
}
