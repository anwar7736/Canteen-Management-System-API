<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthlyStatement;

class MonthlyStatementController extends Controller
{
    public function GetAllMonthlyStatement(Request $req)
    {
        $token_no = $req->token_no;
        $statements = MonthlyStatement::where('token_no', $token_no)->get();
        return $statements;
    }
    public function GetYearsAndMonths(Request $req)
    {
        $years = MonthlyStatement::groupBy('year')->select('year')->get();

        $months = MonthlyStatement::groupBy('month')->select('month')->get();

        return ["years"=>$years, "months"=>$months];


        

    }
    public function GetMonthlyStatementByKey(Request $req)
    {
        $token_no = $req->token_no;
        $year = $req->year;
        $month = $req->month;
        if($year && $month)
        {
            $statements = MonthlyStatement::where(['year'=>$year,'month'=>$month,'token_no'=>$token_no])->get();

            return $statements;
        }
        else if($year && !$month)
        {
            $statements = MonthlyStatement::where(['year'=>$year,'token_no'=>$token_no])->get();

            return $statements;
        } 
        else
        {
            $statements = MonthlyStatement::where(['month'=>$month,'token_no'=>$token_no])->get();

            return $statements;
        }
        
    }
}
