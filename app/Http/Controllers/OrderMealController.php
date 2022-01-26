<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\OrderMeal;
use App\Models\MealRate;
use App\Models\Payment;
use App\Models\MonthlyStatement;

class OrderMealController extends Controller
{
    public function CountSummary($token_no)
    {
        $first_day = date('Y-m-d', strtotime('first day of this month'));
        $last_day = date('Y-m-d', strtotime('last day of this month'));

        $meal_rate = MealRate::select('lunch_rate', 'dinner_rate')->first();
        $total_lunch = OrderMeal::where('token_no', $token_no)
                            ->whereBetween('meal_given_date', [$first_day, $last_day])
                            ->sum('lunch');
        $lunch_cost = $meal_rate->lunch_rate * $total_lunch;

        $total_dinner = OrderMeal::where('token_no', $token_no)
                            ->whereBetween('meal_given_date', [$first_day, $last_day])
                            ->sum('dinner');
        $dinner_cost = $meal_rate->dinner_rate * $total_dinner;

        $total_meal = $total_lunch + $total_dinner;

        $total_cost = $lunch_cost +  $dinner_cost;

        $total_payment = Payment::where('token_no', $token_no)
                                ->whereBetween('payment_date', [$first_day, $last_day])
                                ->sum('amount');

        $give_take = $total_cost - $total_payment;

        $give = '';
        $take = '';

        if($give_take < 0)
        {
            $take = abs($give_take);
            $give = 0;
        }
        else {
            $take = 0;
            $give = $give_take;
        }

        $year = date('Y');
        $months = ["January", "February", "March", 
        "April", "May", "June", 
        "July", "August", "September", 
        "October", "November", "December"];
        $month = $months[date('m')-1];
        return array(
            "total_lunch" => $total_lunch, 
            "lunch_cost" => $lunch_cost,  
            "total_dinner" => $total_dinner, 
            "dinner_cost" => $dinner_cost, 
            "total_meal" => $total_meal,
            "total_cost" => $total_cost,
            "total_payment" => $total_payment,
            "give" => $give,
            "take" => $take,
            "year"  =>  $year,
            "month" => $month,
        );
    }
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

            if($result)
            {
                $summary = $this->CountSummary($token_no);
                $rowCount = MonthlyStatement::where([
                                            'year'=>$summary['year'],
                                            'month'=>$summary['month'],
                                            'token_no'=>$token_no
                                            ])->count();


                if($rowCount > 0)
                {
                    $updated = MonthlyStatement::where([
                        'year'=>$summary['year'],
                        'month'=>$summary['month'],
                        'token_no'=>$token_no
                        ])->update([
                        'total_lunch' => $summary['total_lunch'],
                        'lunch_cost' => $summary['lunch_cost'],
                        'total_dinner' => $summary['total_dinner'],
                        'dinner_cost' => $summary['dinner_cost'],
                        'total_meal' => $summary['total_meal'],
                        'total_cost' => $summary['total_cost'],
                        'total_payment' => $summary['total_payment'],
                        'give' => $summary['give'],
                        'take' => $summary['take'],
                ]);

                }   
                else{
                    //Insert
                   $inserted = MonthlyStatement::insert([
                                        'year'=>$summary['year'],
                                        'month'=>$summary['month'],
                                        'token_no' => $token_no,
                                        'total_lunch' => $summary['total_lunch'],
                                        'lunch_cost' => $summary['lunch_cost'],
                                        'total_dinner' => $summary['total_dinner'],
                                        'dinner_cost' => $summary['dinner_cost'],
                                        'total_meal' => $summary['total_meal'],
                                        'total_cost' => $summary['total_cost'],
                                        'total_payment' => $summary['total_payment'],
                                        'give' => $summary['give'],
                                        'take' => $summary['take'],
                                ]);

                }
                return $result;
            }
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
        $token_no      =  $req->token_no;
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
        if($result)
        {
            $summary = $this->CountSummary($token_no);
            $updated = MonthlyStatement::where([
                'year'=>$summary['year'],
                'month'=>$summary['month'],
                'token_no'=>$token_no
                ])->update([
                'total_lunch' => $summary['total_lunch'],
                'lunch_cost' => $summary['lunch_cost'],
                'total_dinner' => $summary['total_dinner'],
                'dinner_cost' => $summary['dinner_cost'],
                'total_meal' => $summary['total_meal'],
                'total_cost' => $summary['total_cost'],
                'total_payment' => $summary['total_payment'],
                'give' => $summary['give'],
                'take' => $summary['take'],
        ]);
            return $result;
        }
    }

    public function DeleteTodayOrderedMeal(Request $req)
    {
        $order_id = $req->order_id;
        $token_no =  $req->token_no;
        $result   = OrderMeal::find($order_id)->delete();
        if($result)
        {
            $summary = $this->CountSummary($token_no);
            $updated = MonthlyStatement::where([
                'year'=>$summary['year'],
                'month'=>$summary['month'],
                'token_no'=>$token_no
                ])->update([
                'total_lunch' => $summary['total_lunch'],
                'lunch_cost' => $summary['lunch_cost'],
                'total_dinner' => $summary['total_dinner'],
                'dinner_cost' => $summary['dinner_cost'],
                'total_meal' => $summary['total_meal'],
                'total_cost' => $summary['total_cost'],
                'total_payment' => $summary['total_payment'],
                'give' => $summary['give'],
                'take' => $summary['take'],
        ]);
            return $result;
        }
       
    }
    
    public function RestoreTodayOrderedMeal(Request $req)
    {
        $order_id = $req->order_id;
        $token_no =  $req->token_no;
        $result   = OrderMeal::withTrashed()->find($order_id)->restore();
        if($result)
        {
            $summary = $this->CountSummary($token_no);
            $updated = MonthlyStatement::where([
                'year'=>$summary['year'],
                'month'=>$summary['month'],
                'token_no'=>$token_no
                ])->update([
                'total_lunch' => $summary['total_lunch'],
                'lunch_cost' => $summary['lunch_cost'],
                'total_dinner' => $summary['total_dinner'],
                'dinner_cost' => $summary['dinner_cost'],
                'total_meal' => $summary['total_meal'],
                'total_cost' => $summary['total_cost'],
                'total_payment' => $summary['total_payment'],
                'give' => $summary['give'],
                'take' => $summary['take'],
        ]);
            return $result;
        }
    }
}
