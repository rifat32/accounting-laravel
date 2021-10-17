<?php

namespace App\Http\Services;

use App\Models\Bank;
use App\Models\Revenue;
use Illuminate\Support\Facades\DB;
use App\Http\Utils\TransactionUtils;

trait RevenueServices
{
    use TransactionUtils;
    public function createRevenueService($request)
    {
        $bank = Bank::where([
            "account_number" => $request["account_number"],
            "wing_id" => $request["wing_id"]
        ])->first();
        if (!$bank) {
            return response()->json(["message" => "bank account number not found"], 404);
        }

        $request["bank_id"]  = $bank->id;

        $revenue =  Revenue::create($request->toArray());
        return response()->json(["revenue" => $revenue], 201);
    }
    public function getRevenuesService($request)
    {
        $revenues =   Revenue::with("wing")->paginate(100);
        return response()->json([
            "revenues" => $revenues
        ], 200);
    }
    public function approveRevenueService($request)
    {
        $revenueQuery =  Revenue::where(["id" => $request->id]);
        $revenue = $revenueQuery->first();

        if ($revenue->status === 0 || $revenue->status === false) {
            DB::transaction(function () use (&$revenueQuery, &$revenue) {
                $revenueQuery->update([
                    "status" => true
                ]);

                $transaction_id = $this->updateBalanceAndTransaction($revenue->wing_id, $revenue->bank_id, $revenue->account_number, $revenue->amount, "revenue");
                if ($transaction_id !== -1) {
                    Revenue::where([
                        "id" => $revenue->id
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
