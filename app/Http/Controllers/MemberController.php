<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class MemberController extends Controller
{
    function AllMembers()
    {
        $members = User::where('role', 'user')->get();
        return $members;
    }

    function AddNewMember(Request $req)
    {
        
    }
    
    function ViewMemberById(Request $re)
    {

    }
    function EditMember(Request $req)
    {
        
    }
    
    function DeleteMember(Request $req)
    {
        
    }
}
