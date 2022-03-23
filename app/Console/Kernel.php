<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Storage;
class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule)
    {
        //Daily order reminder
        // $schedule->command('daily:order')
        //          ->timezone('Asia/Dhaka')
        //          ->dailyAt('22:00'); 
        
        //Change daily meal status
        // $schedule->command('status:pending')
        //          ->timezone('Asia/Dhaka')
        //          ->dailyAt('21:44'); 

        // //Daily Database Backup
        // $schedule->command('backup:clean')->timezone('Asia/Dhaka')->dailyAt('22:09');
        // $schedule->command('backup:run')->timezone('Asia/Dhaka')->dailyAt('22:09');

        //Some payment reminder
        // $schedule->command('some:payment')
        //          ->timezone('Asia/Dhaka')
        //          ->monthlyOn(11, '80:00');
                 
        // //User inactive
        // $schedule->command('user:inactive')
        //         ->timezone('Asia/Dhaka')
        //         ->monthlyOn(16, '24:00');

       //Monthly Statement
        // $schedule->command('monthly:report')
        //         ->timezone('Asia/Dhaka')
        //         ->lastDayOfMonth('22:00');

    }


    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
