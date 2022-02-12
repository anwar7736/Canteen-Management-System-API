<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealRate;

class MealRateController extends Controller
{
    public function GetMealRate(Request $req)
    {
        $meal_rates = MealRate::all();
        return $meal_rates;
    }

    public function ChangeMealRate(Request $req)
    {
        $id = $req->id;
        $lunch_time  = $req->lunch_expiry_time;
        $dinner_time  = $req->dinner_expiry_time;
        $lunch_rate  = (int)$req->lunch_rate;
        $lunch_rate_bangla  = $req->lunch_rate_bangla;
        $dinner_rate = (int)$req->dinner_rate;
        $dinner_rate_bangla = $req->dinner_rate_bangla;
        $total_rate  = $lunch_rate + $dinner_rate;
        date_default_timezone_set("Asia/Dhaka");
        $meal_rate = MealRate::find($id);
        $meal_rate->lunch_expiry_time = $lunch_time;
        $meal_rate->dinner_expiry_time = $dinner_time;
        $meal_rate->lunch_rate = $lunch_rate;
        $meal_rate->lunch_rate_bangla = $lunch_rate_bangla;
        $meal_rate->dinner_rate = $dinner_rate;
        $meal_rate->dinner_rate_bangla = $dinner_rate_bangla;
        $meal_rate->total_rate = $total_rate;
        $result = $meal_rate->save();
        return $result;
    }
}
