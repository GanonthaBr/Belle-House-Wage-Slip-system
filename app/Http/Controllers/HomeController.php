<?php

namespace App\Http\Controllers;

use App\Models\WageSlip;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        return view('form');
    }
}
