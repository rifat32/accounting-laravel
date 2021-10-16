<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parchase;
use Illuminate\Http\Request;

class ParchaseController extends Controller
{
    public function createParchase(Request $request) {
        // form validation is required
       $parchase =  new Parchase();
       $parchase->supplier = $request->supplier;
       $parchase->reference_no = $request->referenceNo;
       $parchase->purchase_date =  $request->purchaseDate;
       $parchase->purchase_status =  $request->purchaseStatus;
       $parchase->product_id =  (int)$request->productId;
    //    $parchase->amount =  $request->amount;
       $parchase->payment_method =  $request->paymentMethod;
       $parchase->status_type = "parchase";
       $parchase->quantity = (int) $request->quantity;
       $parchase->wing_id = (int) $request->wing_id;
       $parchase->save();
       return response()->json(["parchases"=>$parchase],201);
    }

    public function getParchases(Request $request) {
        $parchases =   Parchase::with("wing","product")->where(["status_type"=>"parchase"])->paginate(100);
        return response()->json([
             "parchases" => $parchases
        ],200);
    }
}
