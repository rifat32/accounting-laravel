<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetUpController extends Controller
{
    public function setUp(Request $request)
    {
        $permissions =  config("setup-config.permissions");
        dd($permissions);

        return "You are done with setup";
    }
}
