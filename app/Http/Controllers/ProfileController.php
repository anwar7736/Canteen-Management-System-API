<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Storage;

class ProfileController extends Controller
{
	function GetUserProfile($id)
	{
		$id = $id;
		$userInfo = User::where('id', $id)->first();
        return   array(
            'name' => $userInfo->name,
            'username' => $userInfo->username,
            'email' => $userInfo->email,
            'phone' => $userInfo->phone,
            'photo' => $userInfo->photo,
            'address' => $userInfo->address,
        );
	}

    function UpdateProfile(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $username = $request->username;
        $email = $request->email;
        $phone = $request->phone;
        $photo = $request->file('photo');
        $address = $request->address;

        $userInfo = User::where('id', $id)->get();
        $userCount = User::where('username', $username)->count();
        $emailCount = User::where('email', $email)->count();
        $phoneCount = User::where('phone', $phone)->count();

        if($userInfo[0]['username']!==$username && $userCount > 0)
        {
            return "Username already exists";
        }

        else if($userInfo[0]['email']!==$email && $emailCount > 0)
        {
            return "Email address already exists";
        } 

        else if($userInfo[0]['phone']!==$phone && $phoneCount > 0)
        {
            return "Phone number already exists";
        }

        else
        {
        if($photo=='')
        {
            $result = User::where('id', $id)
                    ->update([
                        'name' => $name,
                        'username' => $username,
                        'email' => $email,
                        'phone'    => $phone,
                        'address'  => $address
                    ]);
            if($result==true)
            {
                $userInfo = User::where('id', $id)->get();
                return   array(
                    'name' => $userInfo[0]['name'],
                    'username' => $userInfo[0]['username'],
                    'email' => $userInfo[0]['email'],
                    'phone' => $userInfo[0]['phone'],
                    'photo' => $userInfo[0]['photo'],
                    'address' => $userInfo[0]['address'],
                );
            }
            else
            {
                return 0;
            }
        }

        else
        {
             $userInfo = User::where('id', $id)->get();
             $domain = explode('/', $userInfo[0]['photo'])[2];

             if($domain==='127.0.0.1:8000')
             { 
                $oldPhotoName = explode('/', $userInfo[0]['photo'])[4];
                Storage::delete('public/'.$oldPhotoName); 
               
             }

            $photoPath = $photo->store('public');
            $photoName = explode('/', $photoPath)[1];
            $photoURL  = 'http://'.$_SERVER['HTTP_HOST'].'/storage/'.$photoName;

            $result = User::where('id', $id)
                    ->update([
                        'name' => $name,
                        'username' => $username,
                        'email' => $email,
                        'phone'    => $phone,
                        'photo'    => $photoURL,
                        'address' => $address,
                    ]);
            if($result==true)
            { 
                $userInfo = User::where('id', $id)->get();
                return   array(
                    'name' => $userInfo[0]['name'],
                    'username' => $userInfo[0]['username'],
                    'email' => $userInfo[0]['email'],
                    'phone' => $userInfo[0]['phone'],
                    'photo' => $userInfo[0]['photo'],
                    'address' => $userInfo[0]['address'],
                );
            }
            else
            {
                return 0;
            }
        }
    }
    }
}
