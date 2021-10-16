<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\CreditNote;
use Illuminate\Http\Request;

class CreditNoteController extends Controller
{
    public function createCreditNote(Request $request) {
        //   form validation is required

        $creditNote =  new CreditNote();
        $creditNote->date = $request->date;
        $creditNote->amount =(int) $request->amount;
        $creditNote->account =  $request->account;
        $creditNote->customer =  $request->customer;
        $creditNote->description =  $request->description;
        $creditNote->category =  $request->category;
        $creditNote->reference =  $request->reference;
        $creditNote->wing_id = (int) $request->wing_id;

        $creditNote->save();
        return response()->json(["creditNote"=>$creditNote],201);
        }

            public function getCreditNotes(Request $request) {
                $creditNotes =   CreditNote::with("wing")->paginate(100);
                return response()->json([
                     "creditNotes" => $creditNotes
                ],200);
            }
            public function approveCreditNote(Request $request) {

                  // should use db transcaction
               $creditNoteQuery =  CreditNote::where(["id"=>$request->id]);
               $creditNote = $creditNoteQuery->first();
               if($creditNote->status === 0){
                $creditNoteQuery ->update([
                    "status" => true
                ]);
                $balanceQuery = Balance::where([
                    "wing_id" => $creditNote->wing_id,
                    "bank_id" => 1
                ]);
                $balance = $balanceQuery->first();
                if(!$balance) {
                    $balanceQuery->insert(
                        [
                            "wing_id" => $creditNote->wing_id,
                            "bank_id" => 1,
                            "amount" =>  $creditNote->amount
                        ]
                    );
                } else {
                    $balanceQuery->update(
                        [
                            "amount" => $balance->amount + $creditNote->amount

                        ]
                    );
                }


               }



                return response()->json([
                     "ok" => true
                ],200);
            }
}
