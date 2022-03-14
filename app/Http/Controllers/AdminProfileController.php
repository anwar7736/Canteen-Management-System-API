<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $owner_phone = $req->owner_phone;
        $owner_email = $req->owner_email;

        if($shop_logo == "")
        {
            $result = AdminProfile::updateOrCreate(
            ['owner_email' => $owner_email],
            [
                'shop_name' => $shop_name,
                'shop_address' => $shop_address,
                'shop_owner' => $shop_owner,
                'owner_phone' => $owner_phone,
                'owner_email' => $owner_email
            ]);

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
                    'owner_phone' => $owner_phone,
                    'owner_email' => $owner_email
                ]);
                
                return $result ? 1 : 0;
        }
    }
}
