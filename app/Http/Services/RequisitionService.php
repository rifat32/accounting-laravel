<?php

namespace App\Http\Services;

use App\Models\Balance;
use App\Models\Bank;
use App\Models\Parchase;
use App\Http\Utils\TransactionUtils;
use Illuminate\Support\Facades\DB;

trait RequisitionService
{
    use TransactionUtils;
    public function createRequisitionService($request)
    {

        if (!$request->user()->can("create requisition")) {
            return response()->json([
                "message" => "you do not have permission"
            ], 403);
        }

        $request["status_type"]  = "requisition";
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
        $requisition = Parchase::create($request->toArray());
        return response()->json(["requisition" => $requisition], 201);
    }
    public function getRequisitionsService($request)
    {

        if (!($request->user()->can("create requisition") || $request->user()->can("cancel requisition") || $request->user()->can("approve requisition"))) {
            return response()->json([
                "message" => "you do not have permission"
            ], 403);
        }

        $parchases =   Parchase::with("wing", "product")->where(["status_type" => "requisition"])->paginate(10);
        return response()->json([
            "requisitions" => $parchases
        ], 200);
    }
    public function requisitionToParchaseService($request)
    {
        if (!$request->user()->can("approve requisition")) {
            return response()->json([
                "message" => "you do not have permission"
            ], 403);
        }


        $requisitionQuery =   Parchase::where(["id" => $request->id]);
        $requisition = $requisitionQuery->first();

        if ($requisition->status_type !== "parchase") {
            DB::transaction(function () use (&$requisitionQuery, &$requisition) {
                $requisitionQuery->update([
                    "status_type" => "parchase"
                ]);
                if ($requisition->bank_id) {
                    $amount = -$requisition->amount();
                    $transaction_id = $this->updateBalanceAndTransaction($requisition->wing_id, $requisition->bank_id, $requisition->account_number, $amount, "parchase");
                    if ($transaction_id !== -1) {
                        Parchase::where([
                            "id" => $requisition->id
                        ])->update([
                            "transaction_id" => $transaction_id
                        ]);
                    }
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
