<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WingRequest;
use App\Models\Wing;
use Illuminate\Http\Request;
use App\Http\Services\WingServices;

class WingController extends Controller
{
    use WingServices;
    public function createWing(WingRequest $request)
    {
        return $this->createWingServices($request);
    }
    public function getWings(Request $request)
    {
        return $this->getWingsServices($request);
    }
    public function getAllWings(Request $request)
    {
        return $this->getAllWingsServices($request);
    }
}
