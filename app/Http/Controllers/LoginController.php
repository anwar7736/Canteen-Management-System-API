<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OTPModel;
use App\Mail\AdminVerification;
use Hash;
use Mail;

class LoginController extends Controller
{
    public function onLogin(Request $req)
    {
        $username = $req->username;
        $password = $req->password;
        $user_info = User::where('username', $username)->first();
        if($user_info && Hash::check($password, $user_info->password))
        {
            // if($user_info->role === "admin")
            // {
            //     $otp = rand(111111,999999);
            //     date_default_timezone_set('Asia/Dhaka');
            //     $date = date('Y-m-d');
            //     $time = date('h:i:sa', strtotime("+5 Minutes"));
    
            //     $result = OTPModel::insert([
            //         'email' => $user_info->email,
            //         'otp' => $otp,
            //         'time' => $time,
            //         'date' => $date
            //     ]);

            //     if($result)
            //     {
            //         $data = ['name' => $user_info->name, 'otp'=> $otp];
            //         Mail::to($user_info->email)->send(new AdminVerification($data));
            //         return array('admin', $user_info->email); 
            //     }
            // }
                return array('user', $user_info);
        }
        else{
            return 0;
        }
    }
}
