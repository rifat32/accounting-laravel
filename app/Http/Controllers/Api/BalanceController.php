<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransferBalanceRequest;
use App\Models\Balance;
use Illuminate\Http\Request;
use App\Http\Services\BalanceServices;

class BalanceController extends Controller
{
    use BalanceServices;
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
    public function transferBalance(TransferBalanceRequest $request)
    {
        return $this->transferBalanceService($request);
    }
}
