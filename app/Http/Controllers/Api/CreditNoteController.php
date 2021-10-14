<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $creditNote->save();
        return response()->json(["creditNote"=>$creditNote],201);
        }
        // {
            //     "date": "2021-10-14",
            //     "amount": "10",
            //     "account": "sadefaer aeraerg ",
            //     "customer": "erfgre gaerge",
            //     "description": "fttghr",
            //     "category": "eargeg",
            //     "reference": "1015"
            // }
            public function getCreditNotes(Request $request) {
                $creditNotes =   CreditNote::paginate(100);
                return response()->json([
                     "creditNotes" => $creditNotes
                ],200);
            }
}
