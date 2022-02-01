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
            if($user_info->status==='active')
            {
                return array('user', $user_info);
            }
            else{
                return "inactive";
            }
            
                
        }
        else{
            return 0;
        }
    }
        public function AdminLogin(Request $req)
        {
            $username = $req->username;
            $password = $req->password;
            $admin_info = User::where('username', $username)->first();
            if($admin_info && Hash::check($password, $admin_info->password))
            {
                return $admin_info;
                    
            }
            else{
                return 0;
            }

        }
    }

