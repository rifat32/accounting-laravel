<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createPayment(Request $request) {

        $payment =  new Payment();
        $payment->date = $request->date;
        $payment->amount = (int) $request->amount;
        $payment->account =  $request->account;
        $payment->description =  $request->description;
        $payment->category =   $request->category;
        $payment->reference =  $request->reference;
        $payment->wing_id = (int) $request->wing_id;
        $payment->save();
        return response()->json(["payment"=>$payment],201);
        }
            public function getPayment(Request $request) {
                $payments =   Payment::with("wing")->paginate(100);
                return response()->json([
                     "payments" => $payments
                ],200);
            }
            public function approvePayment(Request $request) {

                $PaymentQuery =  Payment::where(["id"=>$request->id]);
                $payment = $PaymentQuery->first();
                if($payment->status === 0){
                 $PaymentQuery ->update([
                     "status" => true
                 ]);
                 $balanceQuery = Balance::where([
                     "wing_id" => $payment->wing_id,
                     "bank_id" => 1
                 ]);
                 $balance = $balanceQuery->first();
                 if(!$balance) {
                     $balanceQuery->insert(
                         [
                             "wing_id" => $payment->wing_id,
                             "bank_id" => 1,
                             "amount" =>  -$payment->amount
                         ]
                     );
                 } else {
                     $balanceQuery->update(
                         [
                             "amount" => $balance->amount - $payment->amount

                         ]
                     );
                 }


                }



                 return response()->json([
                      "ok" => true
                 ],200);
            }
}
