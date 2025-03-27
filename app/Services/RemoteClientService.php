<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RemoteClientService
{
    protected $baseUrl;
    public function __construct()
    {
        $this->baseUrl = 'https://api.bellehouseniger.com/api';
    }
    public function getAllClient()
    {
        $response = Http::get($this->baseUrl . '/clients');
        return $response->json();
    }
    public function getClient_byIid($client_id)
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/clients/{$client_id}");
        return $response->json();
    }
}
