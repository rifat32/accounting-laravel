<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function getTotalBalance(Request $request)
    {
        $balance =  Balance::sum("amount");
        return response()->json([
            "balance" => $balance
        ], 200);
    }
    public function getBalanceByWingAndBank($wing_id, $bank_id)
    {
        $balance =  Balance::where([
            "wing_id" => $wing_id,
            "bank_id" => $bank_id
        ])->sum("amount");
        return response()->json([
            "balance" => $balance
        ], 200);
    }
    public function getBalanceByWing($wing_id)
    {
        $balance =  Balance::where([
            "wing_id" => $wing_id,
        ])->sum("amount");
        return response()->json([
            "balance" => $balance
        ], 200);
    }
}
