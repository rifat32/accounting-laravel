<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParchaseRequest;
use App\Models\Parchase;
use Illuminate\Http\Request;
use App\Http\Services\ParchaseServices;

class ParchaseController extends Controller
{
    use ParchaseServices;
    public function createParchase(ParchaseRequest $request)
    {
        return $this->createParchaseService($request);
    }

    public function getParchases(Request $request)
    {
        return $this->getParchasesService($request);
    }
}
