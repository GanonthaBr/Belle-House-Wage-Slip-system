<?php

namespace App\Http\Controllers;

use App\Models\WageSlip;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //last 5 wage slips
        $wageslips = WageSlip::orderBy('id', 'desc')->take(4)->get();
        return view('home', ['wageslips' => $wageslips]);
    }
    public function employees()
    {
        return view('employees');
    }
}
