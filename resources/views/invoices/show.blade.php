<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link href="logo.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<style>
    body {
        font-family: "Roboto", sans-serif;
        background-color: #f7f7ff;
        margin: 0rem;
        padding: 0rem;
        width: 80%;
        align-content: center;
        margin-left: 2rem;
    }
    a{
        text-decoration: none;
        color: #61a1d6;
    }
    .text-end a {
        color: #fff;
    }
    .company p {
        font-size: 12px;
        text-align: center;
    }
    .company-details span {
        font-size: 14px;
    }
    .container {
        display: flex;
        justify-content: center;
        width: 100%;
        background-color: #fff;
        padding: 5px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .container form {
        width: 100%;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .mb-3 {
        width: 100%;
        margin-bottom: 1rem;
    }
    .itemField {
        width: 100%;
    }
    #invoice {
        padding: 0px;
        width: 100%;
    }
    .header-div {
        /* width:100% ; */
    }
    .invoice {
        /* position: absolute; */
        background-color: #fff;
        min-height: 680px;
        padding: 5px;
    }
    .invoice header {
        padding: 5px 0;
        margin-bottom: 5px;
        border-bottom: 1px solid #61a1d6;
    }
    .invoice .company-details {
        text-align: right;
    }
    .invoice .company-details .details {
        text-align: left;
    }
    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0;
    }
    .invoice .company-details .name a {
        color: #61a1d6;
        font-size: 27px;
    }
    .invoice .contacts {
        margin-bottom: 5px;
        font-size: 12px;
    }
    .invoice .invoice-to {
        text-align: left;
    }
    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0;
    }
    .invoice .invoice-details {
        text-align: right;
    }
    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #61a1d6;
        font-size: 14px;
    }
    .designation {
        font-size: 12px;
        text-align: center;
    }
    .designation h2 {
        font-size: 16px;
        padding: 2px 3px;
        border: 1px solid #61a1d6;
        margin-top: 0;
        color: #61a1d6;
    }
    .invoice main {
        padding-bottom: 2px;
    }
    .invoice main .thanks {
        margin-top: -80px;
        font-size: 1em;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .invoice main .notices {
        padding: 5px;
        padding-left: 6px;
        border-left: 6px solid #61a1d6;
        background: #e7f2ff;
    }
    .invoice main .notices .title {
        color: #61a1d6;
        text-decoration: underline;
    }
    .invoice main .notices .notice {
        font-size: 0.7em;
    }
    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 10px;
    }
    .invoice table td,.invoice table th {
        padding: 5px;
        background: #eee;
        border-bottom: 1px solid #fff;
    }
    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 12px;
    }
    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #61a1d6;
        font-size: 14px;
    }
    .invoice table .qty,.invoice table .total, .invoice table .unit {
        text-align: center;
        font-size: 12px;
    }
    .invoice table .no {
        color: #fff;
        font-size: 12px;
        background: #61a1d6;
    }
    .invoice table .unit {
        background: #ddd;
    }
    .invoice table .total {
        background: #61a1d6;
        color: #fff;
    }
    .invoice table tbody tr:last-child td {
        border: none;
    }
    .invoice table tfoot td {
        background: #fff;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 3px 7px;
        font-size: 10px;
        border-top: 1px solid #aaa;
    }
    .invoice table tfoot tr:first-child td {
        border-top: none;
    }
    .invoice table tfoot tr:last-child td {
        color: #61a1d6;
        font-size: 12px;
        border-top: 1px solid #61a1d6;
    }
    .invoice table tfoot tr td:first-child {
        border: none;
    }
    footer {
        bottom: 10px;
        width: 100%;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 0;
        text-align: center;
    }
    footer span {
        font-size: 10px;
    }
    footer b{
        text-align: center;
    }
    @media print {
        .header-div{
            margin: 0;
            padding: 0;
        }
        .invoice {
            font-size: 11px !important;
            overflow: hidden !important;
            padding: 0;
        }
        footer {
            bottom: 10px;
            width: 100%;
            padding: 0;
            margin-top: 100px;
            /* page-break-after: always; */
        }
        /* .invoice>div:last-child {
            page-break-before: always;
        } */
    }
    .invoice main .notices {
        padding: 7px;
        padding-left: 6px;
        border-left: 6px solid #61a1d6;
        background: #e7f2ff;
    }
    .invoice .text-left p {
        font-size: 10px;
    }
    .invoice .text-left h4 {
        font-size: 12px;
    }
    .text-right {
        text-align: center;
    }
    .info {
        width: 100%;
        flex-direction: column;
        justify-content: space-between;
    }
    .info .col {
        width: 50%;
    }
    th {
        font-weight: bold;
    }
    .header-content table td,.header-content table th,.contacts table th,.contacts table td {
        font-size: 10px;
        padding: 3px;
        background: #fff !important;
        border-bottom: 1px solid #fff;
    }
    .black-footer {
        color: #000000
    }
</style>

<body>
    <!-- nav bar -->
     <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('public/images/logo.png') }}" alt="logo" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create-invoice') }}">Nouvelle Facture</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('download',$invoice['id'])}}">Telecharger en PDF</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('invoice-edit',$invoice['id'])}}">Modifier</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('delete-invoice', $invoice['id']) }}" method="POST" style="display: inline-block;">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="invoice">
        <div class="header-div">
            <header class="header-content">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 40%;"></th>
                                    <th style="width: 60%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="col">
                                            <a href="#">
                                                <img src="{{ asset('public/images/logo.png') }}" width="180" height="140" alt="logo" />
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col company-details">
                                            <h2 class="name">
                                                <a target="_blank" href="#"> <b>BELLE HOUSE</b> </a>
                                            </h2>
                                            <b style="font-size: 8px;"> ENTREPRISE DE CONSTRUCTION MODERNE </b>
                                            <div>Adresse : <span style="color:#61a1d6">Bobiel Niamey-Niger</span> </div>
                                            <div>Numéro de téléphone : <span style="color:#61a1d6">+227 92 08 50 50</span> </div>
                                            <div class="email">Email:
                                                <a href="mailto:contact@bellehouseniger.com"><span class="__cf_email__" data-cfemail="cca6a3a4a28ca9b4ada1bca0a9e2afa3a1" style="color:#61a1d6">Contact@bellehouseniger.com</span></a>
                                            </div>
                                            <div class="email">Site Web:
                                                <a href="www.bellehouseniger.com"><span class="__cf_email__"> <span style="color:#61a1d6">bellehouseniger.com</span> </span></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
            </header>
            <main>
                <div class="row contacts">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 35%;"></th>
                                        <th style="width: 30%;"></th>
                                        <th style="width: 35%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="col invoice-to">
                                                <div class="text-gray-light">Délivré à:</div>
                                                <h3 class="to">client_name</h3>
                                                <div class="address">Quartier,Niamey-Niger</div>
                                                <div class="address">
                                                    Tel: 898989383
                                                </div>
                                                <div class="email">
                                                    <a href="mailto:'client@gmail.com"><span class="__cf_email__" data-cfemail="cca6a3a4a28ca9b4ada1bca0a9e2afa3a1">client@gmail.com</span></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="designation">
                                                <h2>{{$invoice['name']}}</h2>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col invoice-details">
                                                <h1 class="invoice-id" style="font-size:12px">Numéro de facture : BH/2025/{{$invoice['number']}}</h1>
                                                <div class="date">Date: <b>{{$invoice['echeance']}}</b> </div>
                                                <div class="date">Délai de validité: <b>{{$invoice['echeance']}}</b> </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row subject">
                            <div class="col-12">
                                <p> <b style="text-decoration: underline;">Object:</b>{{$invoice['topic']}}  </p>
                            </div>
                        </div>
                        <table style="width: 100%; table-layout: fixed; ">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th class="text-left" style="width: 40%; font-weight:bold">Désignation</th>
                                    <th class="text-right" style="width: 15%; font-weight:bold ">Quantité</th>
                                    <th class="text-right" style="width: 20%; font-weight:bold; text-align:center">Prix Unitaire HT <br> (FCFA)</th>
                                    <th class="text-right" style="width: 20%; font-weight:bold ">Prix Total HT <br> (FCFA)</th>
                                </tr>
                            </thead>
                            <tbody>                         
                                
                                @foreach ($invoice['designations'] as $item)
                                     <tr class="listings">
                                    <td class="no item_number">1</td>
                                    <td class="text-left" style="min-width: 500px;border-right: 1px solid #fff">
                                        <h4>{{$item['designation_title']}}</h4>
                                        <p>{{$item['designation_details']}}</p>
                                    </td>
                                    <td class="qty">{{$item['designation_quantity']}}</td>
                                    <td class="unit">{{$item['designation_unit_price']}}</td>
                                    <td class="total">{{ $item['designation_price'] }} </td>
                                </tr>
                                @endforeach
                               
                            
                              
                                   
                               
                                
                            </tbody>
                            <tfoot style="font-size: 10px;">
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">Montant Total HT</td>
                                    <td> {{ $invoice['total'] }} <b> FCFA</b> </td>
                                </tr>
                                 @if ($invoice['tax'])
                                
                                    <tr>
                                    <td colspan="2"></td>
                                     @if ($invoice['type_tax'] == 'ISB')
                                    
                                    <td colspan="2"> Tax {{$invoice['type_tax']}} 2%</td>
                                    @else
                                    <td colspan="2"> Tax {{$invoice['type_tax']}} 16%</td>
                                    
                                    @endif
                                    <td> <b> {{$invoice['total_amount'] -  $invoice['total'] }} FCFA</b> </td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2"> Tax</td>
                                    <td> <b> 0 FCFA</b> </td>
                                </tr>
                                @endif
                                    
                               
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">Montant Total TTC</td>
                                    <td> {{$invoice['total_amount']}} FCFA</b> </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">Net à payer</td>
                                    <td> <b> {{$invoice['total_amount']}} FCFA</b> </td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="thanks">Merci!</div>
                        <div class="notices">
                            <div class="title">NOTE Importante!</div>
                            <div class="notice">
                                <b> Mode de règlement </b> Payment Mode <br>
                            </div>
                        </div>
            </main>
            
        </div>
    </div>

    <footer>
        <span> Compte Ecobank: <b class="black-footer">160940732001</b> Compte Orabank: <b class="black-footer">76495401901 </b>Compte BIA: <b class="black-footer">61001260006</b>  Compte BOA: <b class="black-footer">004404430009</b> </span>
        <span><b class="black-footer"> RCCM-NE-NIM-01-2017-A10-02845- NIF : 43391/P.</b></span>
    </footer>
</body>
</html>
