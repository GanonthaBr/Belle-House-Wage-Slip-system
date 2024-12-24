<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RemoteInvoiceService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://invoice.bellehouseniger.com';
    }
    public function getAllInvoices(): string
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/invoices");
        return $response->json();
    }
}
