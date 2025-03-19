<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RemoteInvoiceService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://api.bellehouseniger.com/api';
    }
    public function getAllInvoices()
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/invoices");
        return $response->json();
    }
    public function getClient_byIid($client_id)
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/clients/{$client_id}");
        return $response->json();
    }
    //get one Invoice
    public function getInvoice($id)
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/invoices/{$id}");
        return $response->json();
    }
    //Download Invoice
    public function downloadInvoice($id)
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/invoices/{$id}/download_pdf");
        return $response->download();
        // return $response;
    }
    //create invoice
    public function createInvoice($data)
    {
        $response = Http::accept('application/json')->post("{$this->baseUrl}/invoices/", $data);
        return $response->json();
    }
    //update invoice
    public function updateInvoice($id, array $data): array
    {
        $response = Http::withOptions(['verify' => false])->put("{$this->baseUrl}/invoices/{$id}", $data);
        return $response->json();
    }
    //delete invoice
    public function deleteInvoice($id): array
    {
        $response = Http::withOptions(['verify' => false])->delete("{$this->baseUrl}/invoices/{$id}");
        return $response->json();
    }
}
