<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RemoteEmployeeService
{
    protected $baseUrl;
    public function __construct()
    {
        $this->baseUrl = 'https://api.bellehouseniger.com/api';
    }
    public function getAllEmployees()
    {
        $response = Http::get($this->baseUrl . '/employees');
        return $response->json();
    }
    public function get_employee_byID($id)
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/employees/{$id}");
        return $response->json();
    }
    public function createEmployee($data)
    {
        $response = Http::accept('application/json')->post("{$this->baseUrl}/employees/", $data);
        return $response->json();
    }
    public function updateEmployee($id, array $data): array
    {
        $response = Http::accept('application/json')->put("{$this->baseUrl}/employees/{$id}/", $data);
        // dd($response);
        return $response->json();
    }
    public function deleteEmployee($id)
    {
        $res = Http::delete("{$this->baseUrl}/employees/{$id}");
        return [];
    }
}
