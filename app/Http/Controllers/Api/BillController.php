<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    //
    // $table->string("vendor");
    // $table->date("billDate");
    // $table->date("dueDate");
    // $table->string("category");
    // $table->integer("orderNumber");
    // $table->boolean("discountApply");

    public function createBill(Request $request) {

        $bill =  new Bill();
        $bill->vendor = $request->vendor;
        $bill->bill_date =  $request->billDate;
        $bill->due_date =  $request->dueDate;
        $bill->category =  $request->category;
        $bill->order_number =  (int) $request->orderNumber;
        $bill->discount_apply =  $request->discountApply;
        $bill->wing_id = (int)$request->wing_id;
        $bill->save();
        return response()->json(["bill"=>$bill],201);
        }
            public function getBills(Request $request) {
                $bills =   Bill::with("wing")->paginate(100);
                return response()->json([
                     "bills" => $bills
                ],200);
            }
            public function getBillsByWing(Request $request,$wingId) {
                $bills =   Bill::with("wing")->where([
                    "wing_id" => $wingId
                ])->get();
                return response()->json([
                     "bills" => $bills
                ],200);
            }
}
