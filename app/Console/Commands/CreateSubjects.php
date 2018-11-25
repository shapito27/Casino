<?php

namespace App\Console\Commands;

use App\Services\Operation;
use App\Services\SubjectAccountType;
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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $newSubject = (new \App\Services\Subject());
        $newSubject1 = $newSubject
            ->add([
                'name' => 'Ipad Gray',
                'description' => '128Gb',
            ]);

        \App\Services\Account::updateBalance((new SubjectAccountType())->getSystemAccountId(), $newSubject1->id,
            Operation::DEBET);

        $newSubject2 = $newSubject
            ->add([
                'name' => '3D Телевизор',
                'description' => 'Samsung GH12SDF',
            ]);
        \App\Services\Account::updateBalance((new SubjectAccountType())->getSystemAccountId(), $newSubject2->id,
            Operation::DEBET);

        $newSubject3 = $newSubject
            ->add([
                'name' => 'Путешествие в Тайланд',
                'description' => '6 days in 4* Hotel',
            ]);
        \App\Services\Account::updateBalance((new SubjectAccountType())->getSystemAccountId(), $newSubject3->id, Operation::DEBET);
    }
}
