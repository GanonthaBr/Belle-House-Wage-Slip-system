<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class WageSlipController extends Controller
{
    public function create()
    {
        return view('form');
    }

    public function downloadPDF()
    {
        try {
            // ini_set('max_execution_time', 10000);

            $data = [];
            $pdf = PDF::loadView('pdf.bulletin_salaire', $data);
            return $pdf->download('invoice.pdf');
        } catch (\Throwable $e) {


            return redirect()->route('home')->with('error', 'Une erreur est survenue lors du telechargement');
        }
    }
}
