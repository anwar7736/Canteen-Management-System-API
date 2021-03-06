<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\OrderMeal;
use App\Models\DailyBazarCost;
use App\Models\MealRate;
use App\Models\User;
use App\Models\Notification;
use App\Models\NotificationDetail;
use App\Models\Payment;
use App\Models\MonthlyStatement;

class DashboardController extends Controller
{
    public function AdminDashboardSummary(Request $req)
    {
        $total_customer = User::where('role', 'user')->count();
        $first_day = date('Y-m-d', strtotime('first day of this month'));
        $last_day = date('Y-m-d', strtotime('last day of this month'));

        $total_meal = OrderMeal::whereBetween('meal_given_date', [$first_day, $last_day])
                                    ->sum('total_meal');

        $total_meals = OrderMeal::whereBetween('meal_given_date', [$first_day, $last_day])
                                    ->withTrashed()
                                    ->sum('total_meal');
        $total_cancel_meal = $total_meals - $total_meal;

        $total_bazar_cost = DailyBazarCost::whereBetween('date', [$first_day, $last_day])
                                            ->sum('amount'); 

        $total_payments = Payment::whereBetween('payment_date', [$first_day, $last_day])
                                            ->sum('amount');

        $total_due = MonthlyStatement::sum('take');

        $total_earnings = $total_payments - $total_due;

        $total_user_due = MonthlyStatement::sum('give');

        $today_lunch_order = OrderMeal::where('meal_given_date', date('Y-m-d'))
                                        ->sum('lunch'); 

        $today_dinner_order = OrderMeal::where('meal_given_date', date('Y-m-d'))
                                        ->sum('dinner');

        return array(
                    "total_customer" => $total_customer,
                    "total_meal" => $total_meal,
                    "total_cancel_meal" => $total_cancel_meal,
                    "total_bazar_cost" => round($total_bazar_cost),
                    "total_earnings" => round($total_earnings),
                    "total_user_due" => round($total_user_due),
                    "today_lunch_order" => $today_lunch_order,
                    "today_dinner_order" => $today_dinner_order,

                    );
       

    }

    public function CountDashboardSummary(Request $req)
    {
        $user_id = $req->user_id;
        $first_day = date('Y-m-d', strtotime('first day of this month'));
        $last_day = date('Y-m-d', strtotime('last day of this month'));

        $meal_rate = MealRate::select('lunch_rate', 'dinner_rate')->get();
        $total_lunch = OrderMeal::where('user_id', $user_id)
                            ->whereBetween('meal_given_date', [$first_day, $last_day])
                            ->sum('lunch');
        $total_dinner = OrderMeal::where('user_id', $user_id)
                            ->whereBetween('meal_given_date', [$first_day, $last_day])
                            ->sum('dinner');
        $total_meal = $total_lunch + $total_dinner;
        $total_cost = OrderMeal::where('user_id', $user_id)
                            ->whereBetween('meal_given_date', [$first_day, $last_day])
                            ->sum('total_amount');
        $total_working_day = date('d');
        $month_last_date = date('d', strtotime('last day of this month'));
        $Remaining_working_day =  $month_last_date -  $total_working_day;
        $unread_notification = NotificationDetail::where('user_id', $user_id)
                                                 ->where('status', 'Latest')
                                                 ->orWhere('status', 'Unread')
                                                 ->count();

        $total_sending_message = Notification::where('author_id', $user_id)->count();

        $user = User::where('id', $user_id)->first();
        $total_payment = Payment::where('token_no', $user->token_no)
                                ->whereBetween('payment_date', [$first_day, $last_day])
                                ->sum('amount');

        return array(
            "Meal_Rate" => $meal_rate,
            "Lunch" => $total_lunch, 
            "Dinner" => $total_dinner, 
            "Total_Meal" => $total_meal,
            "Total_Cost" => $total_cost,
            "Total_Payment" => $total_payment,
            "Total_Due" => "0",
            "Total_Working_Day" => $total_working_day,
            "Remaining_Working_Day" => $Remaining_working_day,
            "Unread_Notification" => $unread_notification,
            "Total_Sending_Message" => $total_sending_message,
        
        );
    }

    public function LastFivePaymentDetails(Request $req)
    {
        $token_no = $req->token_no;
        $payments = Payment::where('token_no', $token_no)
                            ->orderBy('id', 'desc')
                            ->limit(5)
                            ->get();
        return $payments;
    }
    
    public function LastFiveMonthsStatements(Request $req)
    {
        $token_no = $req->token_no;
        $statements = MonthlyStatement::where('token_no', $token_no)
                            ->orderBy('id', 'desc')
                            ->limit(5)
                            ->get();
        return $statements;
    }
    
    public function LastSevenDaysMealReport(Request $req)
    {
        $user_id = $req->user_id;
        $meal_report = OrderMeal::where('user_id', $user_id)
                            ->orderBy('id', 'desc')
                            ->limit(7)
                            ->get();
        return $meal_report;
    }


}
