<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyBazarCost;

class DailyBazarCostController extends Controller
{
    function GetAllBazarCost()
    {
        $data = DailyBazarCost::orderBy('id', 'desc')->get();
        return $data;
    } 

    function GetBazarCostByDate(Request $req)
    {
        $from_date = $req->from_date;
        $to_date   = $req->to_date;

        $data = DailyBazarCost::whereBetween('date', [$from_date, $to_date])->get();
        return $data;
    }

    function AddDailyBazarCost(Request $req)
    {
        $name = $req->name;
        $amount = $req->amount;
        $year = date('Y');
        $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September","October",	"November", "December"];
        $month = $months[date('m')-1];
        $date = date('Y-m-d');
        $result = DailyBazarCost::updateOrCreate(
                                    ['date'=> $date],
                                    [
                                    'year' => $year,
                                    'month' => $month,
                                    'name' => $name,
                                    'amount' => $amount,
                                ]);
        return $result ? 1 : 0;
    }
    
    function EditDailyBazarCost(Request $req)
    {
        $cost_id = $req->cost_id;
        $data = DailyBazarCost::where('id', $cost_id)->first();
        $data_year = $data->year;
        $data_month = $data->month;
        $current_year = date('Y');
        $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September","October",	"November", "December"];
        $current_month = $months[date('m')-1];
        $name = $req->name;
        $amount = $req->amount;
        if(($data_year == $current_year) && ($data_month == $current_month))
        {
            $bazar_cost = DailyBazarCost::findOrFail($cost_id);
            $bazar_cost->name =  $name;
            $bazar_cost->amount =  $amount;
            $bazar_cost->save(); 
            return $bazar_cost ? 1 : 0;
        }
        return 0;
    }
    
    function DeleteDailyBazarCost(Request $req)
    {
        $cost_id = $req->cost_id;
        $data = DailyBazarCost::where('id', $cost_id)->first();
        $data_year = $data->year;
        $data_month = $data->month;
        $current_year = date('Y');
        $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September","October",	"November", "December"];
        $current_month = $months[date('m')-1];
        if(($data_year == $current_year) && ($data_month == $current_month))
        {
            $bazar_cost = DailyBazarCost::findOrFail($cost_id);
            $bazar_cost->delete();
            return $bazar_cost ? 1 : 0;
        }
        return 0;
    }
}
