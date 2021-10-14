<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function createRevenue(Request $request) {
        //   form validation is required

        $revenue =  new Revenue();
        $revenue->date = $request->date;
        $revenue->amount =(int) $request->amount;
        $revenue->account =  $request->account;
        $revenue->customer =  $request->customer;
        $revenue->description =  $request->description;
        $revenue->category =  $request->category;
        $revenue->reference =  $request->reference;
        $revenue->save();
        return response()->json(["revenue"=>$revenue],201);
        }
            public function getRevenues(Request $request) {
                $revenues =   Revenue::paginate(100);
                return response()->json([
                     "revenues" => $revenues
                ],200);
            }
}
