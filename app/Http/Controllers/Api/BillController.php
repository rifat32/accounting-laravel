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
        $bill->billDate =  $request->billDate;
        $bill->dueDate =  $request->dueDate;
        $bill->category =  $request->category;
        $bill->orderNumber =  (int) $request->orderNumber;
        $bill->discountApply =  $request->discountApply;
        $bill->save();
        return response()->json(["bill"=>$bill],201);
        }
            public function getBills(Request $request) {
                $bills =   Bill::paginate(100);
                return response()->json([
                     "bills" => $bills
                ],200);
            }
}
