<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WageSlipController extends Controller
{
    public function create()
    {
        return view('form');
    }
}
