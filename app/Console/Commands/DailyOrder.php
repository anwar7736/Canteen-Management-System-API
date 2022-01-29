<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderReminder;
use App\Models\User;
use App\Models\OrderMeal;

class DailyOrder extends Command
{

    protected $signature = 'daily:order';

    protected $description = 'Daily Order Reminder';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::where('role', 'user')->get();
        foreach($users as $user)
        {
            $date = date('Y-m-d', strtotime('+1 day'));
            $token_no = $user->token_no;
            $isExist = OrderMeal::where(['token_no'=>$token_no,'meal_given_date'=>$date])->count();
            if($isExist===0)
            {
                Notification::send($user, new OrderReminder($user->name));
            }
        }

    }
}
