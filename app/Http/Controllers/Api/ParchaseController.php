<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Requisition;
use Illuminate\Http\Request;

class ParchaseController extends Controller
{
    public function createRequisition(Request $request) {
        // form validation is required

       $requisition =  new Requisition();
       $requisition->rSupplier = $request->rSupplier;
       $requisition->rReferenceNo = $request->rReferenceNo;
       $requisition->rPurchaseDate =  $request->rPurchaseDate;
       $requisition->rPurchaseStatus =  $request->rPurchaseStatus;
       $requisition->rProductId =  $request->rProductId;
       $requisition->rAmount =  $request->rAmount;
       $requisition->rPaymentMethod =  $request->rPaymentMethod;
       $requisition->rStatusType = "parchase";
       $requisition->save();
       return response()->json(["parchases"=>$requisition],201);
        // {
            //     "rSupplier": "",
            //     "rReferenceNo": "",
            //     "rPurchaseDate": "",
            //     "rPurchaseStatus": "",
            //     "rProductId": 2,
            //     "rAmount": "",
            //     "rPaymentMethod": ""
            // }
    }

    public function getRequisitions(Request $request) {
        $requisitions =   Requisition::where(["rStatusType"=>"parchase"])->paginate(100);
        return response()->json([
             "parchases" => $requisitions
        ],200);
    }
}
