<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
class PaymentDetailsController extends Controller
{
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
