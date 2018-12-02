<?php

namespace app\Console\Commands;

use Illuminate\Console\Command;

class CreateRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'casino:createRoles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create roles';

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
        //create role admin
        $owner = new \App\Models\Role();
        $owner->name = 'admin';
        $owner->display_name  = 'Admin of portal';
        $owner->description = 'Men who has many permissions';
        $owner->save();


        //create role user
        $owner = new \App\Models\Role();
        $owner->name = 'user';
        $owner->display_name  = 'Common person';
        $owner->description = 'Can play game';
        $owner->save();

        echo "Success!\n";
    }
}
