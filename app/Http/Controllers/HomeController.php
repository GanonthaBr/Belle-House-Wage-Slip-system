<?php

namespace App\Http\Controllers;

use App\Models\WageSlip;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $wageslips = WageSlip::all();
        return view('home', ['wageslips' => $wageslips]);
    }
}
