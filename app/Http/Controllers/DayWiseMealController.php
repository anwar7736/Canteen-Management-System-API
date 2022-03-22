<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderMeal;
use DB;

class DayWiseMealController extends Controller
{
    public function GetAllMealByUser(Request $req)
    {
        $user_id = $req->user_id;
        $data = OrderMeal::where('user_id', $user_id)
                        ->orderBy('id', 'desc')->get();
        return $data;
    }
    
    public function GetMealByOrderId(Request $req)
    {
        $order_id = $req->order_id;
        $data = OrderMeal::where('id', $order_id)->first();
        $user_id = $data->user_id;
        $details = DB::table('users')
                ->join('order_meals', 'order_meals.user_id', 'users.id')
                ->where(['order_meals.id'=>$order_id])
                ->get();
                
        return $details;
    }
    
    public function GetAllMealDetails(Request $req)
    {
        $data = OrderMeal::orderBy('id', 'desc')->get();
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
    
    public function GetMealByFilter(Request $req)
    {
        $token_no = $req->token_no;
        $from_date = $req->from_date;
        $to_date = $req->to_date;
        $data = "";

        if($token_no == "")
        {
            $data = OrderMeal::whereBetween('meal_given_date', array($from_date, $to_date))
                             ->orderBy('id', 'desc')->get();
        }
        else if($from_date == "" && $to_date == ""){
            $data = OrderMeal::where('token_no', $token_no)->get();
        }
        else {
            $data = OrderMeal::whereBetween('meal_given_date', array($from_date, $to_date))
                            ->where('token_no', $token_no)->get();
        }
        
        return $data;
        
    }
}
