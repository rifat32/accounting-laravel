<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\DebitNote;
use Illuminate\Http\Request;

class DebitNoteController extends Controller
{
// {
            //     "bill": "dgefagarfe",
            //     "amount": "100",
            //     "date": "2021-10-14",
            //     "description": "dfghdfg dfgh gfh gf sgjgfr rtgh rfgh strgtrfgh srgjsrf j rstjrstj yyghj"
            // }


    public function createDebitNote(Request $request) {

        $debitNote =  new DebitNote();
        $debitNote->bill_id = (int)$request->bill;
        $debitNote->amount = (int) $request->amount;
        $debitNote->date =  $request->date;
        $debitNote->description =  $request->description;
        $debitNote->wing_id = (int) $request->wing_id;
        $debitNote->save();
        return response()->json(["debitNote"=>$debitNote],201);
        }
            public function getDebitNotes(Request $request) {
                $debitNotes =   DebitNote::with("wing","bill")->paginate(100);
                return response()->json([
                     "debitNotes" => $debitNotes
                ],200);
            }
            public function approveDebitNote(Request $request) {
                  // should use db transcaction
               $debitNoteQuery =  DebitNote::where(["id"=>$request->id]);
               $debitNote = $debitNoteQuery->first();
               if($debitNote->status === 0){
                $debitNoteQuery ->update([
                    "status" => true
                ]);
                $balanceQuery = Balance::where([
                    "wing_id" => $debitNote->wing_id,
                    "bank_id" => 1
                ]);
                $balance = $balanceQuery->first();
                if(!$balance) {
                    $balanceQuery->insert(
                        [
                            "wing_id" => $debitNote->wing_id,
                            "bank_id" => 1,
                            "amount" =>  -$debitNote->amount
                        ]
                    );
                } else {
                    $balanceQuery->update(
                        [
                            "amount" => $balance->amount - $debitNote->amount

                        ]
                    );
                }


               }



                return response()->json([
                     "ok" => true
                ],200);
            }
}
