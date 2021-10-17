<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use App\Http\Utils\TransactionUtils;
use App\Models\Bank;
use App\Models\Parchase;


trait ParchaseServices
{
    use TransactionUtils;
    public function createParchaseService($request)
    {
        if ($request["account_number"]) {
            $bank = Bank::where([
                "account_number" => $request["account_number"],
                "wing_id" => $request["wing_id"]
            ])->first();
            if (!$bank) {
                return response()->json(["message" => "bank account number not found"], 404);
            }
            $request["bank_id"]  = $bank->id;
        }
        return    DB::transaction(function () use (&$request) {
            $request["status_type"]  = "parchase";
            $parchase = Parchase::create($request->toArray());

            $amount = -$parchase->amount();
            if ($parchase->bank_id) {
                $transaction_id = $this->updateBalanceAndTransaction($parchase->wing_id, $parchase->bank_id, $parchase->account_number, $amount, "parchase");
                if ($transaction_id !== -1) {
                    Parchase::where([
                        "id" => $parchase->id
                    ])->update([
                        "transaction_id" => $transaction_id
                    ]);
                }
            }

            return response()->json(["parchase" => $parchase], 201);
        });
    }
    public function getParchasesService($request)
    {
        $parchases =   Parchase::with("wing", "product")->where(["status_type" => "parchase"])->paginate(100);
        return response()->json([
            "parchases" => $parchases
        ], 200);
    }
}
