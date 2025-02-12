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

        return view('invoices.index', ['invoices' => $invoices]);
    }
    // show
    public function show($id)
    {
        $invoice = $this->remoteInvoiceService->getInvoice($id);
        return view('invoices.show', ['invoice' => $invoice]);
    }
    public function download($id)
    {
        return $this->remoteInvoiceService->downloadInvoice($id);
    }
}
