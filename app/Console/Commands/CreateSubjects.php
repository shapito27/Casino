<?php

namespace App\Console\Commands;

use App\Services\SubjectAccount;
use App\Services\Transfer;
use Illuminate\Console\Command;

class CreateSubjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'casino:createSubjects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * Create many subjects
     * @throws \App\Exceptions\BalanceNotExistsException
     * @throws \App\Exceptions\NotDefinedOperationTypeException
     * @throws \App\Exceptions\NotSetedAccountIdException
     * @throws \App\Exceptions\SystemAccountNotFoundException
     * @throws \Throwable
     */
    public function handle()
    {
        $newSubject = app('\App\Services\Subject');
        $newSubject1 = $newSubject
            ->add([
                'name' => 'Ipad Gray',
                'description' => '128Gb',
            ]);

        /** @var SubjectAccount $subjectAccount */
        $subjectAccount = app('subject.account');
        $subjectAccount->setAccountId($subjectAccount->getSystemAccountId());

        $subjectAccount->updateBalance($newSubject1->id, Transfer::DEBET);

        $newSubject2 = $newSubject
            ->add([
                'name' => '3D Телевизор',
                'description' => 'Samsung GH12SDF',
            ]);
        $subjectAccount->updateBalance($newSubject2->id, Transfer::DEBET);

        $newSubject2 = $newSubject
            ->add([
                'name' => '3D Телевизор White',
                'description' => 'Samsung GH12SDF',
            ]);
        $subjectAccount->updateBalance($newSubject2->id, Transfer::DEBET);

        $newSubject2 = $newSubject
            ->add([
                'name' => '3D Телевизор Red',
                'description' => 'Samsung GH12SDF',
            ]);
        $subjectAccount->updateBalance($newSubject2->id, Transfer::DEBET);

        $newSubject2 = $newSubject
            ->add([
                'name' => '3D Телевизор Green',
                'description' => 'Samsung GH12SDF',
            ]);
        $subjectAccount->updateBalance($newSubject2->id, Transfer::DEBET);

        $newSubject2 = $newSubject
            ->add([
                'name' => '3D Телевизор Yellow',
                'description' => 'Samsung GH12SDF',
            ]);
        $subjectAccount->updateBalance($newSubject2->id, Transfer::DEBET);

        $newSubject3 = $newSubject
            ->add([
                'name' => 'Путешествие в Тайланд',
                'description' => '6 days in 4* Hotel',
            ]);
        $subjectAccount->updateBalance($newSubject3->id, Transfer::DEBET);

        $newSubject1 = $newSubject
            ->add([
                'name' => 'Ipad Red',
                'description' => '128Gb',
            ]);

        $subjectAccount->updateBalance($newSubject1->id, Transfer::DEBET);

        $newSubject1 = $newSubject
            ->add([
                'name' => 'Ipad Black',
                'description' => '128Gb',
            ]);

        $subjectAccount->updateBalance($newSubject1->id, Transfer::DEBET);

        $newSubject1 = $newSubject
            ->add([
                'name' => 'Ipad white',
                'description' => '128Gb',
            ]);

        $subjectAccount->updateBalance($newSubject1->id, Transfer::DEBET);


        $newSubject1 = $newSubject
            ->add([
                'name' => 'Ipad Orange',
                'description' => '128Gb',
            ]);

        $subjectAccount->updateBalance($newSubject1->id, Transfer::DEBET);
    }
}
