<?php

namespace App\Console\Commands;

use App\ConfigHelper;
use App\Models\User;
use App\Services\BonusAccount;
use App\Services\MoneyAccount;
use App\Services\SubjectAccount;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateModerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'casino:createModerator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create system user';

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
        $password = '3sdf980sd8fsdf';

        //Create admin
        $user = new User();
        $user->name = 'Moderator';
        $user->password = Hash::make($password);
        $user->email = 'example@test.ru';
        $user->save();
        $user->attachRole(\App\Models\Role::getAdmin());

        /**
         * Create admin's accounts
         */

        //Create admin's money accounts
        /** @var MoneyAccount $moneyAccount */
        $moneyAccount = app('money.account');
        $moneyAccount->create($user->id);
        //добавляем в конфиг денежный счет админа
        ConfigHelper::setEnvironmentValue('SYSTEM_MONEY_ACCOUNT', $moneyAccount->getAccountId());

        //Create admin's bonus accounts
        /** @var BonusAccount $bonusAccount */
        $bonusAccount = app('bonus.account');
        $bonusAccount->create($user->id);
        //добавляем в конфиг бонусный счет админа
        ConfigHelper::setEnvironmentValue('SYSTEM_BONUS_ACCOUNT', $bonusAccount->getAccountId());

        //Create admin's subject accounts
        /** @var SubjectAccount $subjectAccount */
        $subjectAccount = app('subject.account');
        $subjectAccount->create($user->id);
        //добавляем в конфиг предметный счет админа
        ConfigHelper::setEnvironmentValue('SYSTEM_SUBJECT_ACCOUNT', $subjectAccount->getAccountId());

        echo "Success!\n";
    }
}
