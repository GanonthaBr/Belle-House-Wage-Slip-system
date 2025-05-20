@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Tableau de Bord Belle House</h1>
            {{-- show session message --}}
            @if (session('error'))    
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @elseif (session('message')) 
            <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
            @endif        
            <div class="row">
                <div class="col-md-6">
                    <div class="card half-screen">
                        <div class="card-body">
                            <h5 class="card-title">
                                Gestion des Clients
                            </h5>
                            <p>Liste des Client dans la base des donnees</p>
                            {{-- list of employees. Just the html without the data, we will the data from js with external API call --}}
                            <ul class="list-group">
                                <table>
                                    <thead>
                                        <th style="width:30%" >ID du Client</th>
                                        <th style="width:70%" >Nom du client</th>
                                    </thead>
                                    <tbody>
                                        {{-- Data fetched from API --}}
                                        @foreach ($clients as $client)
                                   
                                        <tr>
                                            <td>{{$client['id']}}</td>
                                            <td>{{$client['client_name']}}</td>
                                        </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                                
                               
                            </ul>
                            <a href="{{route('employees')}}" class="btn btn-primary m-4">Voir tous les Employees</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card half-screen">
                        <div class="card-body">
                            <h5 class="card-title">
                                Bulletin de Salaires
                            </h5>
                            <p class="card-text">
                                Creer un nouveau bulletin de salaire
                                <a href="{{route('create')}}">ici</a>
                            </p>
                            {{-- list last 3 wageslips --}}
                            <ul class="list-group">
                                @foreach ($wageslips as $wageslip)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{$wageslip->nom_employee}}
                                        <a href="{{route('wageslip-show',$wageslip->id)}}" class="btn btn-primary btn-sm">Voir</a>
                                    </li>
                                @endforeach
                            </ul>
                            {{-- A button to go to the list of all items --}}
                            <a href="{{route('list')}}" class="btn btn-primary m-4">Voir tous les bulletins de salaire</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-2 align-content-center">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-body invoice">
                            <h5 class="card-title">Invoice</h5> 
                            <table style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Clients</th>
                                        <th>Date</th>
                                        <th>Type de Facture</th>
                                        <th>Actions</th>
                                    </tr>

                                </thead>
                                <tbody class="invoice-list">
                                    {{-- <tr>
                                        <td>Client 1</td>
                                        <td>2020-01-01</td>
                                        <td>Invoice 1</td>
                                    </tr>
                                    <tr>
                                        <td>Client 2</td>
                                        <td>2022-01-01</td>
                                        <td>Invoice 2</td>
                                    </tr> --}}
                                </tbody>
                            </table>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection