<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class LoginController extends Controller
{
    public function onLogin(Request $req)
    {
        $username = $req->username;
        $password = $req->password;
        $user_info = User::where('username', $username)->first();
        if($user_info && Hash::check($password, $user_info->password))
        {
            return array('user', $user_info);
        }
        else{
            return 0;
        }
    }
}
