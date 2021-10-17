<?php

namespace App\Http\Services;

use App\Models\Bank;
use App\Models\CreditNote;
use Illuminate\Support\Facades\DB;
use App\Http\Utils\TransactionUtils;

trait CreditNoteServices
{
    use TransactionUtils;
    public function createCreditNoteService($request)
    {
        $bank = Bank::where([
            "account_number" => $request["account_number"],
            "wing_id" => $request["wing_id"]
        ])->first();
        if (!$bank) {
            return response()->json(["message" => "bank account number not found"], 404);
        }

        $request["bank_id"]  = $bank->id;
        $creditNote =  CreditNote::create($request->toArray());
        return response()->json(["creditNote" => $creditNote], 201);
    }
    public function getCreditNotesService($request)
    {
        $creditNotes =   CreditNote::with("wing")->paginate(100);
        return response()->json([
            "creditNotes" => $creditNotes
        ], 200);
    }
    public function approveCreditNoteService($request)
    {
        $creditNoteQuery =  CreditNote::where(["id" => $request->id]);
        $creditNote = $creditNoteQuery->first();

        if ($creditNote->status === 0 || $creditNote->status === false) {
            DB::transaction(function () use (&$creditNoteQuery, &$creditNote) {
                $creditNoteQuery->update([
                    "status" => true
                ]);

                $transaction_id = $this->updateBalanceAndTransaction($creditNote->wing_id, $creditNote->bank_id, $creditNote->account_number, $creditNote->amount, "creditNote");
                if ($transaction_id !== -1) {
                    CreditNote::where([
                        "id" => $creditNote->id
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
