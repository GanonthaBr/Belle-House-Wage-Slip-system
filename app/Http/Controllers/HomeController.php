<?php

namespace App\Http\Controllers;

use App\Models\WageSlip;

use Illuminate\Http\Request;
use App\Services\RemoteInvoiceService;


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

    protected $remoteInvoiceService;

    public function __construct(RemoteInvoiceService $remoteInvoiceService)
    {
        $this->remoteInvoiceService = $remoteInvoiceService;
    }

    public function list()
    {
        $invoices = $this->remoteInvoiceService->getAllInvoices();
        // cast string to array
        $invoices = array($invoices);

        print_r($invoices);
        return view('invoices.index', ['invoices' => $invoices]);
    }
}
