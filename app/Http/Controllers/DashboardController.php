<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\OrderMeal;
use App\Models\MealRate;
use App\Models\User;
use App\Models\Notification;
use App\Models\NotificationDetail;
use App\Models\Payment;
use App\Models\MonthlyStatement;

class DashboardController extends Controller
{
    public function CountDashboardSummary(Request $req)
    {
        $user_id = $req->user_id;
        $meal_rate = MealRate::select('lunch_rate', 'dinner_rate')->get();
        $total_lunch = OrderMeal::where('user_id', $user_id)->sum('lunch');
        $total_dinner = OrderMeal::where('user_id', $user_id)->sum('dinner');
        $total_meal = $total_lunch + $total_dinner;
        $total_cost = OrderMeal::where('user_id', $user_id)->sum('total_amount');
        $total_working_day = date('d');
        $month_last_date = date('d', strtotime('last day of this month'));
        $Remaining_working_day =  $month_last_date -  $total_working_day;
        $unread_notification = NotificationDetail::where('user_id', $user_id)
                                                 ->where('status', 'Latest')
                                                 ->orWhere('status', 'Unread')
                                                 ->count();

        $total_sending_message = Notification::where('author_id', $user_id)->count();

        return [
            "Meal Rate " => $meal_rate,
            "Lunch  " => $total_lunch, 
            "Dinner" => $total_dinner, 
            "Total Meal  " => $total_meal,
            "Total Cost  " => $total_cost,
            "Total Payment  " => "0",
            "Total Due  " => "0",
            "Total Working Day " => $total_working_day,
            "Remaining Working Day " => $Remaining_working_day,
            "Unread Notification " => $unread_notification,
            "Total Sending Message " => $total_sending_message,
        
        ];
    }

    public function LastFivePaymentDetails(Request $req)
    {
        $user_id = $req->user_id;
        $payments = Payment::where('user_id', $user_id)
                            ->orderBy('id', 'desc')
                            ->limit(5)
                            ->get();
        return $payments;
    }
    
    public function LastFiveMonthsStatements(Request $req)
    {
        $user_id = $req->user_id;
        $statements = MonthlyStatement::where('user_id', $user_id)
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
