<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Balance;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Services\PaymentServices;

class PaymentController extends Controller
{
    use PaymentServices;
    public function createPayment(PaymentRequest $request)
    {
        return $this->createPaymentService($request);
    }
    public function getPayment(Request $request)
    {
        return $this->getPaymentService($request);
    }
    public function approvePayment(Request $request)
    {
        return $this->approvePaymentService($request);
        $PaymentQuery =  Payment::where(["id" => $request->id]);
        $payment = $PaymentQuery->first();
        if ($payment->status === 0) {
            $PaymentQuery->update([
                "status" => true
            ]);
            $balanceQuery = Balance::where([
                "wing_id" => $payment->wing_id,
                "bank_id" => 1
            ]);
            $balance = $balanceQuery->first();
            if (!$balance) {
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
        ], 200);
    }
}
