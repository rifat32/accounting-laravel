<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parchase;
use App\Models\Requisition;
use Illuminate\Http\Request;

class RequisitionController extends Controller
{

    public function createRequisition(Request $request) {
        // form validation is required
       $parchase =  new Parchase();
       $parchase->supplier = $request->supplier;
       $parchase->reference_no = $request->referenceNo;
       $parchase->purchase_date =  $request->purchaseDate;
       $parchase->purchase_status =  $request->purchaseStatus;
       $parchase->product_id =  (int)$request->productId;
    //    $parchase->amount =  $request->amount;
       $parchase->payment_method =  $request->paymentMethod;
       $parchase->status_type = "requisition";
       $parchase->quantity = (int) $request->quantity;
       $parchase->wing_id = (int) $request->wing_id;
       $parchase->save();
       return response()->json(["requisition"=>$parchase],201);
    }


    public function getRequisitions(Request $request) {
        $parchases =   Parchase::with("wing","product")->where(["status_type"=>"requisition"])->paginate(100);
        return response()->json([
             "requisitions" => $parchases
        ],200);
    }
    public function requisitionToParchase(Request $request) {
        $requisition =   Parchase::where(["id"=>$request->id])
        ->update(["status_type"=>"parchase"])
        ;
        return response()->json([
            "requisition" => $requisition
       ],200);

    }
}
