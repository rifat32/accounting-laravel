<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Requisition;
use Illuminate\Http\Request;

class RequisitionController extends Controller
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
       $requisition->rStatusType = "requisition";
       $requisition->save();
       return response()->json(["requisition"=>$requisition],201);
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
        $requisitions =   Requisition::where(["rStatusType"=>"requisition"])->paginate(100);
        return response()->json([
             "requisitions" => $requisitions
        ],200);
    }
    public function requisitionToParchase(Request $request) {
        $requisition =   Requisition::where(["id"=>$request->id])
        ->update(["rStatusType"=>"parchase"])
        ;
        return response()->json([
            "requisition" => $requisition
       ],200);

    }
}
