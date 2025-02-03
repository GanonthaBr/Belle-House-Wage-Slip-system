<!-- filepath: /c:/Users/DELL/Desktop/work files/BelleHouse/bulletin-salaire/resources/views/invoices/show.blade.php -->

@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Invoice Details</h1>
    <table class="table">
        <tr>
            <th>Client Name</th>
            <td>{{ $invoice['client_name'] }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $invoice['date'] }}</td>
        </tr>
        <tr>
            <th>Invoice Name</th>
            <td>{{ $invoice['invoice_name'] }}</td>
        </tr>
        <!-- Add more fields as necessary -->
    </table>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
</div>
@endsection