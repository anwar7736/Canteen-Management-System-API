<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MonthlyReport extends Command
{

    protected $signature = 'monthly:report';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        return 0;
    }
}
