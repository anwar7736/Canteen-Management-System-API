<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminProfile;
use Storage;
class AdminProfileController extends Controller
{
    public function GetProfileInfo()
    {
        $data = AdminProfile::all();
        return $data;
    }

    public function UpdateAdminProfile(Request $req)
    {
        $shop_logo = $req->file('shop_logo');
        $shop_name = $req->shop_name;
        $shop_address = $req->shop_address;
        $shop_owner = $req->shop_owner;
        $username = $req->username;
        $owner_phone = $req->owner_phone;
        $admin_info  = User::where('role', 'admin')->first();
        if($shop_owner == "")
        {
            $shop_owner = $admin_info->name;
        }
        if($username == "")
        {
            $username = $admin_info->username;
        }
        if($owner_phone == "")
        {
            $owner_phone = $admin_info->phone;
        }
        $owner_email = $admin_info->email;

        if($shop_logo == "")
        {
            $result = AdminProfile::updateOrCreate(
            ['owner_email' => $owner_email],
            [
                'shop_name' => $shop_name,
                'shop_address' => $shop_address,
                'shop_owner' => $shop_owner,
                'username' => $username,
                'owner_phone' => $owner_phone,
                'owner_email' => $owner_email
            ]);

            if($result)
            {
                User::where('email', $owner_email)->update([
                    'name' => $shop_owner,
                    'username' => $username,
                    'phone' => $owner_phone
                ]);
            }

            return $result ? 1 : 0;
        }

        else {
            $info = AdminProfile::select('*')->first();
            if($info)
            {
                if($info['shop_logo'] != "")
                {
                    $oldLogoURL = explode('/', $info['shop_logo'])[4];
                    Storage::delete('public/'.$oldLogoURL);
                }
            }

            $logoPath = $shop_logo->store('public');
            $logoName = explode('/', $logoPath)[1];
            $logoURL  = 'http://'.$_SERVER['HTTP_HOST'].'/storage/'.$logoName;
            $result = AdminProfile::updateOrCreate(
                ['owner_email' => $owner_email],
                [
                    'shop_logo' => $logoURL,
                    'shop_name' => $shop_name,
                    'shop_address' => $shop_address,
                    'shop_owner' => $shop_owner,
                    'username' => $username,
                    'owner_phone' => $owner_phone,
                    'owner_email' => $owner_email
                ]);

                if($result)
                {
                    User::where('email', $owner_email)->update([
                        'name' => $shop_owner,
                        'username' => $username,
                        'phone' => $owner_phone
                    ]);
                }
                
                return $result ? 1 : 0;
        }
    }
}
