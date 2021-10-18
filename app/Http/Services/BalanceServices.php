<?php

namespace App\Http\Services;

use App\Models\Balance;
use App\Models\Bank;
use App\Models\Transfer;
use Illuminate\Support\Facades\DB;

trait BalanceServices
{

    public function transferBalanceService($request)
    {
        $sending_bank = Bank::getBank($request["sending_wing_id"], $request["sending_account_number"]);
        $recieving_bank = Bank::getBank($request["recieving_wing_id"], $request["recieving_account_number"]);

        if (!($sending_bank && $recieving_bank)) {
            return response()->json([
                "account number did not match"
            ], 400);
        }

        if ($sending_bank->id === $recieving_bank->id) {
            return response()->json([
                "Can not transfer between same bank"
            ], 400);
        }
        $request["sending_bank_id"] = $sending_bank->id;
        $request["recieving_bank_id"] = $recieving_bank->id;
        try {
            // start transaction
            DB::transaction(function () use (&$request, &$sending_bank, &$recieving_bank) {

                $sending_balance =  Balance::getBalance($sending_bank->wing_id, $sending_bank->id);
                // if not in balance throw error
                if ($sending_balance && ($sending_balance->amount >= $request["amount"])) {
                    //   transfer
                    Transfer::create($request->toArray());

                    // update balance for sender
                    $decrease_amount = $sending_balance->amount - (int) $request["amount"];
                    Balance::updateBalance($sending_bank->wing_id, $sending_bank->id, $decrease_amount);

                    // update balance for reciever
                    $recieving_balance =  Balance::getBalance($recieving_bank->wing_id, $recieving_bank->id);

                    if (!$recieving_balance) {
                        Balance::insert([
                            "wing_id" => $recieving_bank->wing_id,
                            "bank_id" => $recieving_bank->id,
                            "amount" => $request["amount"]
                        ]);
                    } else {
                        $increase_amount = $recieving_balance->amount + (int) $request["amount"];
                        Balance::updateBalance($recieving_bank->wing_id, $recieving_bank->id, $increase_amount);
                    }
                } else {
                    throw new \Exception("You do not have sufficient balance to transfer");
                }
            });
        } catch (\Exception $e) {

            return response()->json(["message" => $e->getMessage()], 400);
        }
        return response()->json(["okay" => true], 200);
    }
}
