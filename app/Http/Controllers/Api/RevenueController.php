<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RevenueRequest;
use App\Models\Balance;
use App\Models\Revenue;
use Illuminate\Http\Request;
use App\Http\Services\RevenueServices;

class RevenueController extends Controller
{
    use RevenueServices;
    public function createRevenue(RevenueRequest $request)
    {
        return $this->createRevenueService($request);
    }
    public function getRevenues(Request $request)
    {
        return $this->getRevenuesService(($request));
    }
    public function approveRevenue(Request $request)
    {




        return $this->approveRevenueService($request);


        // $revenueQuery =  Revenue::where(["id" => $request->id]);
        // $revenue = $revenueQuery->first();
        // if ($revenue->status === 0) {
        //     $revenueQuery->update([
        //         "status" => true
        //     ]);
        //     $balanceQuery = Balance::where([
        //         "wing_id" => $revenue->wing_id,
        //         "bank_id" => 1
        //     ]);
        //     $balance = $balanceQuery->first();
        //     if (!$balance) {
        //         $balanceQuery->insert(
        //             [
        //                 "wing_id" => $revenue->wing_id,
        //                 "bank_id" => 1,
        //                 "amount" =>  $revenue->amount
        //             ]
        //         );
        //     } else {
        //         $balanceQuery->update(
        //             [
        //                 "amount" => $balance->amount + $revenue->amount

        //             ]
        //         );
        //     }
        // }



        // return response()->json([
        //     "ok" => true
        // ], 200);
    }
}
