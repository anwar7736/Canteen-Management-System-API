<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\OrderMeal;
use App\Models\MealRate;

class OrderMealController extends Controller
{
    public function OrderDailyMeal(Request $req)
    {
        $user_id         =  $req->user_id;
        $token_no        =  $req->token_no;
        $lunch           =  (int)$req->lunch;
        $dinner          =  (int)$req->dinner;
        $total_meal      =  $lunch + $dinner;

        date_default_timezone_set("Asia/Dhaka");

        $meal_given_date =  date("Y-m-d", strtotime("+1 day"));

        $meal_rates    =  MealRate::first();
        $lunch_rate    =  $meal_rates->lunch_rate;
        $dinner_rate   =  $meal_rates->dinner_rate;
        $lunch_amount  =  $lunch_rate * $lunch ;
        $dinner_amount =  $dinner_rate * $dinner;
        $total_amount  =  $lunch_amount + $dinner_amount;

        $order_count = OrderMeal::where([
                        'user_id'=>$user_id, 
                        'token_no'=>$token_no, 
                        'meal_given_date'=> $meal_given_date
                        ])->first();
        if($order_count)
        {
            return 0;
            

        }
        else {
            $order = new OrderMeal;
            $order->user_id = $user_id;
            $order->token_no = $token_no;
            $order->lunch = $lunch;
            $order->lunch_amount = $lunch_amount;
            $order->dinner = $dinner;
            $order->dinner_amount = $dinner_amount;
            $order->total_meal = $total_meal;
            $order->total_amount = $total_amount;
            $order->meal_given_date = $meal_given_date;
            $result = $order->save();
            return $result;
        }
    }

    public function GetTodayOrderInfo(Request $req)
    {
        $user_id = $req->user_id;
        $token_no = $req->token_no;
        date_default_timezone_set("Asia/Dhaka");
        $meal_given_date =  date("Y-m-d", strtotime("+1 day"));
        $today_order_info = OrderMeal::where([
            'user_id'=>$user_id, 
            'token_no'=>$token_no, 
            'meal_given_date'=> $meal_given_date
            ])->get();

        return  $today_order_info;
    }

    public function ChangeOrderedMeal(Request $req)
    {
        $order_id      =  $req->order_id;
        $lunch         =  (int)$req->lunch;
        $dinner        =  (int)$req->dinner;
        $total_meal    =  $lunch + $dinner;
        $meal_rates    =  MealRate::first();
        $lunch_rate    =  $meal_rates->lunch_rate;
        $dinner_rate   =  $meal_rates->dinner_rate;
        $lunch_amount  =  $lunch_rate * $lunch ;
        $dinner_amount =  $dinner_rate * $dinner;
        $total_amount  =  $lunch_amount + $dinner_amount;
        
        $ordered_meal  =  OrderMeal::find($order_id);
        $ordered_meal->lunch  = $lunch;
        $ordered_meal->lunch_amount = $lunch_amount;
        $ordered_meal->dinner = $dinner;
        $ordered_meal->dinner_amount = $dinner_amount;
        $ordered_meal->total_meal = $total_meal;
        $ordered_meal->total_amount = $total_amount;
        $result = $ordered_meal->save();
        return $result;
    }

    public function DeleteTodayOrderedMeal(Request $req)
    {
        $order_id = $req->order_id;
        $result   = OrderMeal::find($order_id)->delete();
        return $result;
    }
}
