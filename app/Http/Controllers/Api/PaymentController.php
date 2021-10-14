<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // {
    //     "bill": "dgefagarfe",
    //     "amount": "100",
    //     "date": "2021-10-14",
    //     "description": "dfghdfg dfgh gfh gf sgjgfr rtgh rfgh strgtrfgh srgjsrf j rstjrstj yyghj"
    // }
    public function createPayment(Request $request) {

        $payment =  new Payment();
        $payment->date = $request->date;
        $payment->amount = (int) $request->amount;
        $payment->account =  $request->account;
        $payment->description =  $request->description;
        $payment->category =   $request->category;
        $payment->reference =  $request->reference;
        $payment->save();
        return response()->json(["payment"=>$payment],201);
        }
            public function getPayment(Request $request) {
                $payments =   Payment::paginate(100);
                return response()->json([
                     "payments" => $payments
                ],200);
            }
}
