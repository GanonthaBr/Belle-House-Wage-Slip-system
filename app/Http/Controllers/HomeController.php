<?php

namespace App\Http\Controllers;

use App\Models\WageSlip;
use Illuminate\Http\Request;
use App\Services\RemoteInvoiceService;
use App\Services\RemoteClientService;

use Carbon\Carbon;
use Throwable;

class HomeController extends Controller
{
    protected $remoteInvoiceService;
    protected $remoteClientService;

    public function __construct(RemoteInvoiceService $remoteInvoiceService, RemoteClientService $remoteClientService)
    {
        $this->remoteClientService = $remoteClientService;
        $this->remoteInvoiceService = $remoteInvoiceService;
    }
    public function index()
    {
        $clients = $this->remoteClientService->getAllClient();
        // dd($clients);
        //last 5 wage slip
        $wageslips = WageSlip::orderBy('id', 'desc')->take(4)->get();
        return view('home', ['wageslips' => $wageslips, 'clients' => $clients]);
    }
    public function employees()
    {
        return view('employees');
    }
    public function clients()
    {
        $clients = $this->remoteClientService->getAllClient();
        return view('clients', ['clients' => $clients]);
    }

    public function create_client()
    {
        return view('create_client');
    }
    public function delete_client($id)
    {
        // dd('HERE');
        $this->remoteClientService->deleteClient($id);
        return redirect()->route('clients')->with('success', 'Client deleted successfully');
    }
    public function store_client(Request $request)
    {
        try {
            $request->validate([
                'client_name' => 'nullable',
                'client_mail' => 'nullable',
                'client_quartier' => 'nullable',
                'client_phone' => 'nullable',
                'client_country' => 'nullable',
                'client_city' => 'nullable',

            ]);
            $data = $request->all();
            $payload = [
                'client_name' => $data['client_name'],
                'client_mail' => $data['client_mail'],
                'client_quartier' => $data['client_quartier'],
                'client_phone' => $data['client_phone'],
                'client_country' => $data['client_country'],
                'client_city' => $data['client_city'],
            ];
            $response = $this->remoteClientService->createClient($payload);
            return redirect('/');
        } catch (Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
                "montant_avanc" => 'nullable',
                'topic',
                'date',
                'stamp',
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
            // dd($data['tax']);
            if ($data['tax'] == 'OUI') {
                $data['tax'] = true;
            } else {
                $data['tax'] = false;
            }
            if ($data['stamp'] == 'OUI') {
                $data['stamp'] = true;
            } else {
                $data['stamp'] = false;
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
                'stamp' => $data['stamp'],
            ];

            $invoices = $this->remoteInvoiceService->createInvoice($payload);
            return redirect('/');
            // dd($invoices);
        } catch (Throwable $e) {
            // Handle the exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function edit($id)
    {
        $invoice = $this->remoteInvoiceService->getInvoice($id);
        // dd($invoice);
        return view('invoices.update', compact('invoice'));
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'client_id' => 'required',
                'facture_type' => 'required',
                'facture_number' => 'nullable',
                'echeance' => 'required',
                'tax' => 'required',
                'type_tax' => 'nullable',
                'montant_avanc' => 'nullable',
                'topic',
                'date',
                'name',
                'stamp',
                'payment_mode' => 'required',

            ]);
            $data = $request->all();
            // dd($data);
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
            // dd($data);

            //turn response to boolean
            if ($data['tax'] == 'OUI') {
                $data['tax'] = true;
            } else {
                $data['tax'] = false;
            }
            // Stamp
            if ($data['stamp'] == 'OUI') {
                $data['stamp'] = true;
            } else {
                $data['stamp'] = false;
            }
            $payload = [
                'client_id' => $data['client_id'],
                'name' => $data['facture_type'],
                'topic' => $data['topic'],
                'echeance' => $data['echeance'],
                'date' => $data['date'],
                'payment_mode' => $data['payment_mode'],
                'tax' => $data['tax'],
                'number' => $data['facture_number'],
                'montant_avance' => $data['montant_avanc'],
                'type_tax' => $data['type_tax'],
                'designations' => $data['designations'],
                'stamp' => $data['stamp'],
            ];
            // dd($payload);
            $invoice = $this->remoteInvoiceService->updateInvoice($id, $payload);
            // dd($invoice);
            return view('invoices.show', ['invoice' => $invoice]);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()],);
        }
    }
    public function list()
    {
        $invoices = $this->remoteInvoiceService->getAllInvoices();
        // dd($invoices);
        return view('invoices.index', ['invoices' => $invoices]);
    }
    // show
    public function show($id)
    {
        $invoice = $this->remoteInvoiceService->getInvoice($id);
        // dd($invoice);
        return view('invoices.show', ['invoice' => $invoice]);
    }
    public function delete($id)
    {
        $this->remoteInvoiceService->deleteInvoice($id);
        // dd($response);

        return redirect('/')->with(['message' => "Deleted successfully!"]);
    }
    public function download($id)
    {
        return $this->remoteInvoiceService->downloadInvoice($id);
    }
}
