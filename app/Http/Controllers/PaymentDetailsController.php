<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use DB;
use App\Models\MonthlyStatement;
class PaymentDetailsController extends Controller
{

    public function AddPayment(Request $req)
    {
        $token_no = $req->token_no;
        $year     = $req->year;
        $month    = $req->month;
        $status    = $req->status;
        $amount   = $req->amount;
        $userInfo = User::where('token_no', $token_no)->first();
        $trx_id = strtoupper(uniqid());
        date_default_timezone_set("Asia/Dhaka");
        $add_payment = DB::table('payments')
            ->where('transaction_id', $trx_id)
            ->updateOrInsert([
                'year' => $year,
                'month' => $month,
                'name' => $userInfo->name,
                'token_no' => $token_no,
                'email' => $userInfo->email,
                'phone' => $userInfo->phone,
                'amount' => $amount,
                'status' => $status,
                'address' => $userInfo->address,
                'transaction_id' => $trx_id,
                'currency' => "BDT",
                'payment_date' => date('Y-m-d'),
                'payment_time' => date('h:i:sa'),
            ]);

            if($add_payment)
            {
                $previous_data = MonthlyStatement::where([
                    'year'=>$year, 
                    'month'=>$month,
                    'token_no'=>$token_no
                    ])->first(); 

                $total_cost = $previous_data->total_cost;
                $old_total_payment = $previous_data->total_payment;
                $last_total_payment = $old_total_payment + $amount;
                $give_take = $total_cost - $last_total_payment;

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
                $updated = MonthlyStatement::where([
                        'year'=>$year, 
                        'month'=>$month,
                        'token_no'=>$token_no
                    ])->update([
                        'total_payment'=>$last_total_payment, 
                        'give'=>$give,
                        'take'=>$take,
                    ]); 
            }
            return 1;
    }
    
    public function EditPayment(Request $req)
    {
        $payment_id = $req->payment_id;
        $token_no = $req->token_no;
        $year     = $req->year;
        $month    = $req->month;
        $amount   = $req->amount;
        $status   = $req->status;

        $old_payment = Payment::where('id', $payment_id)->first();
        $old_amount = $old_payment->amount;
        $payment_diff = $amount - $old_amount;

        date_default_timezone_set("Asia/Dhaka");
        $update_payment = DB::table('payments')
            ->where('id', $payment_id)
            ->update([
                'year' => $year,
                'month' => $month,
                'amount' => $amount,
                'status' => $status,
            ]);

            if($update_payment)
            {
                $previous_data = MonthlyStatement::where([
                    'year'=>$year, 
                    'month'=>$month,
                    'token_no'=>$token_no
                    ])->first(); 
                
                $total_cost = $previous_data->total_cost;
                $old_total_payment = $previous_data->total_payment;
                $last_total_payment = '';
                if($payment_diff >= 0)
                {
                    $last_total_payment = $old_total_payment + $payment_diff;
                }

                else 
                {
                    $last_total_payment = $old_total_payment - abs($payment_diff);
                }
                $give_take = $total_cost - $last_total_payment;

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
                $updated = MonthlyStatement::where([
                        'year'=>$year, 
                        'month'=>$month,
                        'token_no'=>$token_no
                    ])->update([
                        'total_payment'=>$last_total_payment, 
                        'give'=>$give,
                        'take'=>$take,
                    ]); 
            }
            return 1;
    }
    
    public function DeletePayment(Request $req)
    {
        $payment_id = $req->payment_id;
        $payment = Payment::where('id', $payment_id)->first();
        $token_no =  $payment->token_no;
        $year     = $payment->year;
        $month    = $payment->month;
        $old_amount = $payment->amount;

        date_default_timezone_set("Asia/Dhaka");
        $delete_payment = DB::table('payments')
            ->where('id', $payment_id)->delete();

            if($delete_payment)
            {
                $previous_data = MonthlyStatement::where([
                    'year'=>$year, 
                    'month'=>$month,
                    'token_no'=>$token_no
                    ])->first(); 
                
                $total_cost = $previous_data->total_cost;
                $old_total_payment = $previous_data->total_payment;
                $last_total_payment = $old_total_payment - $old_amount;
                $give_take = $total_cost - $last_total_payment;

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
                $updated = MonthlyStatement::where([
                        'year'=>$year, 
                        'month'=>$month,
                        'token_no'=>$token_no
                    ])->update([
                        'total_payment'=>$last_total_payment, 
                        'give'=>$give,
                        'take'=>$take,
                    ]); 
            }
            return 1;
    }

    public function GetAllPayments()
    {
        $payments = Payment::orderBy('id', 'desc')->get();
        return $payments;

    }

    public function GetAllPaymentByDate(Request $req)
    {
        $from_date = $req->from_date;
        $to_date = $req->to_date;
        $payments = Payment::whereBetween('payment_date', [$from_date, $to_date])
                    ->orderBy('id', 'desc')->get();
        return $payments;
    }
    
    public function GetPaymentById(Request $req)
    {
        $payment_id = $req->payment_id;
        $payment = Payment::where('id', $payment_id)->first();
        return $payment;
    }

    public function PaymentDetailsByUser(Request $req)
    {
        $token_no = $req->token_no;
        $payments = Payment::where('token_no', $token_no)->orderBy('id', 'desc')->get();
        return $payments;
    }

    public function PaymentDetailsFilterByDate(Request $req)
    {
        $token_no = $req->token_no;
        $from_date = $req->from_date;
        $to_date = $req->to_date;
        $payments = Payment::whereBetween('payment_date', [$from_date, $to_date])
                    ->where('token_no', $token_no)
                    ->orderBy('id', 'desc')->get();
        return $payments;
    }
}
