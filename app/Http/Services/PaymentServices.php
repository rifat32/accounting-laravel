<?php

namespace App\Http\Services;

use App\Models\Payment;
use App\Http\Utils\TransactionUtils;
use App\Models\Bank;
use Illuminate\Support\Facades\DB;

trait PaymentServices
{
    use TransactionUtils;
    public function createPaymentService($request)
    {
        $bank = Bank::where([
            "account_number" => $request["account_number"],
            "wing_id" => $request["wing_id"]
        ])->first();
        if (!$bank) {
            return response()->json(["message" => "bank account number not found"], 404);
        }
        $request["bank_id"]  = $bank->id;
        $payment =  Payment::create($request->toArray());
        return response()->json(["payment" => $payment], 201);
    }
    public function getPaymentService($request)
    {
        $payments =   Payment::with("wing")->paginate(100);
        return response()->json([
            "payments" => $payments
        ], 200);
    }
    public function approvePaymentService($request)
    {
        $paymentQuery =  Payment::where(["id" => $request->id]);
        $payment = $paymentQuery->first();

        if ($payment->status === 0 || $payment->status === false) {

            DB::transaction(function () use (&$paymentQuery, &$payment) {
                $paymentQuery->update([
                    "status" => 1
                ]);

                $transaction_id = $this->updateBalanceAndTransaction($payment->wing_id, $payment->bank_id, $payment->account_number, -$payment->amount, "creditNote");

                if ($transaction_id !== -1) {
                    Payment::where([
                        "id" => $payment->id
                    ])->update([
                        "transaction_id" => $transaction_id
                    ]);
                }
            });
            return response()->json([
                "ok" => true
            ], 200);
        } else {
            return response()->json([
                "message" => "duplicate entry"
            ], 409);
        }
    }
}
