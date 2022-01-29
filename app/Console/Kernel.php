<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule)
    {
        //Daily order reminder
        $schedule->command('daily:order')
                 ->timezone('Asia/Dhaka')
                 ->dailyAt('22:00');

        //Some payment reminder
        $schedule->command('some:payment')
                 ->timezone('Asia/Dhaka')
                 ->monthlyOn(11, '08:00');
                 
        //User inactive
        $schedule->command('user:inactive')
                ->timezone('Asia/Dhaka')
                ->monthlyOn(16, '24:00');

       //Monthly Statement
        $schedule->command('monthly:report')
                ->timezone('Asia/Dhaka')
                ->lastDayOfMonth('22:00');

    }


    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
