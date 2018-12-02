<?php

namespace App\Console\Commands;

use App\Services\Transfer;
use Illuminate\Console\Command;

class SendMoney extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'casino:sendMoney {limit=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send money to accounts for users who waited transfer';

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
     * Get limit.
     * Send money to accounts for users who waited transfer
     *
     * @return mixed
     */
    public function handle()
    {
        // get argument limit from cli
        $limit = $this->argument('limit');

        /** @var Transfer $transfer */
        $transfer = app('transfer');
        $transfer->approveWaitedOperations($limit);

        echo "Success!\n";
    }
}
