<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function createBank(Request $request) {
        //   form validation is required

        $bank =  new Bank();
        $bank->name = $request->name;
        $bank->account_number = $request->account_number;
        $bank->wing_id = (int)$request->wing_id;
        $bank->save();
        return response()->json(["bank"=>$bank],201);
        }
            public function getBanks(Request $request) {
                $banks =   Bank::with("wing")->paginate(100);
                return response()->json([
                     "banks" => $banks
                ],200);
            }
}
