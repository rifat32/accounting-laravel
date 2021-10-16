<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wing;
use Illuminate\Http\Request;

class WingController extends Controller
{
    public function createWing(Request $request) {
        //   form validation is required

        $wing =  new Wing();
        $wing->name = $request->name;
        $wing->save();
        return response()->json(["wing"=>$wing],201);
        }
            public function getWings(Request $request) {
                $wings =   Wing::paginate(100);
                return response()->json([
                     "wings" => $wings
                ],200);
            }
            public function getAllWings(Request $request) {
                $wings =   Wing::all();
                return response()->json([
                     "wings" => $wings
                ],200);
            }
}
