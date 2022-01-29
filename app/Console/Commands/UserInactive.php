<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Payment;
class UserInactive extends Command
{

    protected $signature = 'user:inactive';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::where('role', 'user')->get();
        foreach($users as $user)
        {
            $first_day = date('Y-m-d', strtotime('first day of this month'));
            $last_day = date('Y-m-d', strtotime('last day of this month'));
            $token_no = $user->token_no;

            $total_payment = Payment::where('token_no', $token_no)
                                    ->whereBetween('payment_date', [$first_day, $last_day])
                                    ->sum('amount');
            if($total_payment < 1500)
            {
               $inactived = User::where('token_no', $token_no)->update(['status'=>'inactive']);
            }
        }
    }
}
