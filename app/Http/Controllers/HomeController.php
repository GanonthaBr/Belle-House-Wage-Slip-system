<?php

namespace App\Http\Controllers;

use App\Models\WageSlip;
use Illuminate\Http\Request;
use App\Services\RemoteInvoiceService;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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

    //create
    public function create()
    {
        return view('invoices.create');
    }
    //store
    public function store(Request $request)
    {
        try {
            $request->validate([
                'client_id' => 'required',
                'facture_type' => 'required',
                'number' => 'nullable',
                'echeance' => 'required',
                'tax' => 'required',
                'type_tax' => 'nullable',
                'topic',
                'date',
                'payment_mode',
                'payment_mode' => 'required',
            ]);
            $data = $request->all();

            $data['date'] = Carbon::now()->format('Y-m-d');


            // Process designations
            $designations = [];
            foreach ($request->designation_title as $index => $title) {
                $designations[] = [
                    'designation_title' => $title,
                    'designation_details' => $request->designation_details[$index],
                    'designation_quantity' => $request->designation_quantity[$index],
                    'designation_unit_price' => $request->designation_unit_price[$index],
                ];
            }
            $data['designations'] = $designations;
            //get the last added invoice and retrieve its number
            $invoices = $this->remoteInvoiceService->getAllInvoices();
            $lastInvoice = end($invoices);
            $data['number'] = $lastInvoice ? $lastInvoice['number'] + 1 : 1;
            // dd($data['number']);
            //turn response to boolean
            if ($data['tax'] == 'OUI') {
                $data['tax'] = true;
            } else {
                $data['tax'] = false;
            }
            $payload = [
                'client_id' => $data['client_id'],
                'name' => $data['facture_type'],
                'topic' => $data['topic'],
                'echeance' => $data['echeance'],
                'date' => $data['date'],
                'payment_mode' => $data['payment_mode'],
                'tax' => $data['tax'],
                'number' => $data['number'],
                'type_tax' => $data['type_tax'],
                'designations' => $data['designations'],
            ];

            $invoices = $this->remoteInvoiceService->createInvoice($payload);
            // dd($invoices);
        } catch (\Throwable $e) {
            // Handle the exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
