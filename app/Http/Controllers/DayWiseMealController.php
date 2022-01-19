<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderMeal;

class DayWiseMealController extends Controller
{
    public function GetAllMealByUser(Request $req)
    {
        $user_id = $req->user_id;
        $data = OrderMeal::where('user_id', $user_id)
                        ->orderBy('id', 'desc')->get();
        return $data;
    }
    
    public function GetMealFilterByDate(Request $req)
    {
        $user_id = $req->user_id;
        $from_date = $req->from_date;
        $to_date = $req->to_date;
        $data = OrderMeal::whereBetween('meal_given_date', array($from_date, $to_date))
                    ->where('user_id', $user_id)
                    ->orderBy('id', 'desc')->get();
        return $data;
    }
}
