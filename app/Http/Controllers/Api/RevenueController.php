<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Balance;
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
        $revenue->wing_id =(int) $request->wing_id;
        $revenue->save();
        return response()->json(["revenue"=>$revenue],201);
        }
            public function getRevenues(Request $request) {
                $revenues =   Revenue::with("wing")->paginate(100);
                return response()->json([
                     "revenues" => $revenues
                ],200);
            }
            public function approveRevenue(Request $request) {
                // should use db transcaction
               $revenueQuery =  Revenue::where(["id"=>$request->id]);
               $revenue = $revenueQuery->first();
               if($revenue->status === 0){
                $revenueQuery ->update([
                    "status" => true
                ]);
                $balanceQuery = Balance::where([
                    "wing_id" => $revenue->wing_id,
                    "bank_id" => 1
                ]);
                $balance = $balanceQuery->first();
                if(!$balance) {
                    $balanceQuery->insert(
                        [
                            "wing_id" => $revenue->wing_id,
                            "bank_id" => 1,
                            "amount" =>  $revenue->amount
                        ]
                    );
                } else {
                    $balanceQuery->update(
                        [
                            "amount" => $balance->amount + $revenue->amount

                        ]
                    );
                }


               }



                return response()->json([
                     "ok" => true
                ],200);
            }
}
