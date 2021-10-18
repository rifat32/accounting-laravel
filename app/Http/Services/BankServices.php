<?php

namespace App\Http\Services;

use App\Models\Bank;

trait  BankServices
{
    public function createBankService($request)
    {

        $bank = Bank::where(["name" => $request["name"], "account_number" => $request["account_number"]])->first();
        if ($bank) {
            return response()->json(["message" => "This account has already been created"], 400);
        }

        $bank =  Bank::create($request->toArray());
        return response()->json(["bank" => $bank], 201);
    }
    public function getBanksService($request)
    {
        $banks =   Bank::with("wing")->paginate(100);
        return response()->json([
            "banks" => $banks
        ], 200);
    }
    public function getBanksByWingService($request, $wing_id)
    {
        $banks =   Bank::where([
            "wing_id" => $wing_id
        ])->get();
        return response()->json([
            "banks" => $banks
        ], 200);
    }
}
