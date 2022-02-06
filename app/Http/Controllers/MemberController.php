<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Hash,Storage,DB,Mail;
use App\Mail\RegistrationMail;
class MemberController extends Controller
{
    function AllMembers()
    {
        $members = User::where('role', 'user')->get();
        return $members;
    }

    function AddNewMember(Request $request)
    {
        $name = $request->name;
        $username = $request->username;
        $password = Hash::make($request->password);
        $email = $request->email;
        $phone = $request->phone;
        $photo = $request->file('photo');
        $address = $request->address;
        $role = $request->role;
        $status = $request->status;
        $token_no = rand(111111,999999);
    
        $userCount = User::where('username', $username)->count();
        $emailCount = User::where('email', $email)->count();
        $phoneCount = User::where('phone', $phone)->count();

        if($userCount > 0)
        {
            return "Username already exists";
        }

        else if($emailCount > 0)
        {
            return "Email address already exists";
        } 

        else if($phoneCount > 0)
        {
            return "Phone number already exists";
        }

        else
        {
        if($photo=='')
        {
            $member = new User;
            $member->token_no = $token_no;
            $member->name = $name;
            $member->username = $username;
            $member->email  = $email ;
            $member->phone  = $phone ;
            $member->role = $role;
            $member->status = $status;
            $member->password = $password;
            $member->address = $address;
            $result = $member->save();
            if($result)
            {
                $data = [
                          'name' => $name,
                          'reg_date' => date('Y-m-d'),
                          'token_no' => $token_no,
                          'login_url' => 'http://localhost:3000/login',
                          'username'  => $username,
                          'password'  => $request->password

                        ];
                Mail::to($email)->send(new RegistrationMail($data));
                return 1;  
            }
            else
            {
                return 0;
            }
        }

        else
        {
            $photoPath = $photo->store('public');
            $photoName = explode('/', $photoPath)[1];
            $photoURL  = 'http://'.$_SERVER['HTTP_HOST'].'/storage/'.$photoName;
            $member = new User;
            $member->token_no = $token_no;
            $member->name = $name;
            $member->username = $username;
            $member->email  = $email ;
            $member->phone  = $phone ;
            $member->role = $role;
            $member->status = $status;
            $member->password = $password;
            $member->address = $address;
            $member->photo = $photoURL;
            $result = $member->save();
            if($result)
            {
                $data = [
                          'name' => $name,
                          'reg_date' => date('Y-m-d'),
                          'token_no' => $token_no,
                          'login_url' => 'http://localhost:3000/login',
                          'username'  => $username,
                          'password'  => $request->password

                        ];
                Mail::to($email)->send(new RegistrationMail($data));
                return 1;  
            }
            else
            {
                return 0;
            }
        }
    }
    }
    
    function ViewMemberById($id)
    {
		$userInfo = User::where('id', $id)->first();
        return   array(
            'name' => $userInfo->name,
            'username' => $userInfo->username,
            'token_no' => $userInfo->token_no,
            'email' => $userInfo->email,
            'phone' => $userInfo->phone,
            'photo' => $userInfo->photo,
            'address' => $userInfo->address,
            'status' => $userInfo->status,
            'role' => $userInfo->role,
            'password' => $userInfo->password,
            'reg_date' => date("d-m-Y", strtotime($userInfo->created_at)),
        );
    }

    function EditMember(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $username = $request->username;
        $password = $request->password;
        $email = $request->email;
        $phone = $request->phone;
        $photo = $request->file('photo');
        $address = $request->address;
        $role = $request->role;
        $status = $request->status;
        $token_no = $request->token_no;
        
        $userInfo = User::where('id', $id)->get();
        $userCount = User::where('username', $username)->count();
        $emailCount = User::where('email', $email)->count();
        $phoneCount = User::where('phone', $phone)->count();
        $tokenCount = User::where('token_no', $token_no)->count();
        $checkPassword = User::where(['id'=>$id, 'password'=>$password])->count();

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
        
        else if($userInfo[0]['token_no']!=$token_no && $tokenCount > 0)
        {
            return "Token number already exists";
        }

        else
        {
        if($photo=='')
        {
            $member = User::find($id);
            $member->token_no = $token_no;
            $member->name = $name;
            $member->username = $username;
            $member->email  = $email ;
            $member->phone  = $phone ;
            $member->role = $role;
            $member->status = $status;
            $member->address = $address;
            if($checkPassword == 0)
            {
                $member->password = Hash::make($password);
            }
            $result = $member->save();
            if($result)
            {
                return 1;  
            }
            else
            {
                return 0;
            }
        }

        else
        {
            $userInfo = User::where('id', $id)->get();
             if($userInfo[0]['photo'])
             {
                $domain = explode('/', $userInfo[0]['photo'])[2];

                if($domain==='127.0.0.1:8000')
                { 
                   $oldPhotoName = explode('/', $userInfo[0]['photo'])[4];
                   Storage::delete('public/'.$oldPhotoName); 
                  
                }
             }

            $photoPath = $photo->store('public');
            $photoName = explode('/', $photoPath)[1];
            $photoURL  = 'http://'.$_SERVER['HTTP_HOST'].'/storage/'.$photoName;

            $member = User::find($id);
            $member->token_no = $token_no;
            $member->name = $name;
            $member->username = $username;
            $member->email  = $email ;
            $member->phone  = $phone ;
            $member->role = $role;
            $member->status = $status;
            $member->address = $address;
            $member->photo = $photoURL;
            if($checkPassword == 0)
            {
                $member->password = Hash::make($password);
            }
            $result = $member->save();
            if($result)
            {
                return 1;  
            }
            else
            {
                return 0;
            }
        }
    }
    }
    
    function DeleteMember($id)
    {
        $user =  User::where('id', $id)->get();
        
        if($user[0]['photo'])
        {
            $photoName = explode('/', $user[0]['photo'])[4];
            Storage::delete('public/'.$photoName); 
        }

        $result = User::find($id)->delete();
        return $result;


    }
}
