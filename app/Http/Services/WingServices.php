<?php

namespace App\Http\Services;

use App\Models\Wing;

trait WingServices
{
    public function createWingServices($request)
    {
        $wing =   Wing::create($request->toArray());
        return response()->json(["wing" => $wing], 201);
    }
    public function getWingsServices($request)
    {
        $wings =   Wing::paginate(100);
        return response()->json([
            "wings" => $wings
        ], 200);
    }
    public function getAllWingsServices($request)
    {
        $wings =   Wing::all();
        return response()->json([
            "wings" => $wings
        ], 200);
    }
}
