<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RemoteInvoiceService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://api.bellehouseniger.com/api/';
    }
    public function getAllInvoices(): string
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/invoices");
        return $response->json();
    }
    public function getInvoice($id)
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/invoices/{$id}");
        return $response->json();
    }
}
