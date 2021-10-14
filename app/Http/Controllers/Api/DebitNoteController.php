<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $debitNote->bill = $request->bill;
        $debitNote->amount = (int) $request->amount;
        $debitNote->date =  $request->date;
        $debitNote->description =  $request->description;
        $debitNote->save();
        return response()->json(["debitNote"=>$debitNote],201);
        }
            public function getDebitNotes(Request $request) {
                $debitNotes =   DebitNote::paginate(100);
                return response()->json([
                     "debitNotes" => $debitNotes
                ],200);
            }
}
