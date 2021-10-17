<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParchaseRequest;
use App\Models\Parchase;
use Illuminate\Http\Request;
use App\Http\Services\RequisitionService;

class RequisitionController extends Controller
{
    use RequisitionService;
    public function createRequisition(ParchaseRequest $request)
    {
        return $this->createRequisitionService($request);
    }
    public function getRequisitions(Request $request)
    {
        return $this->getRequisitionsService($request);
    }
    public function requisitionToParchase(Request $request)
    {
        return $this->requisitionToParchaseService($request);
    }
}
