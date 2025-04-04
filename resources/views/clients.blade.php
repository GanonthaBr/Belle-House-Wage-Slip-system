@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-title">
                        <h1 class="text-center">Tous les Clients</h1>
                    </div>
                    {{-- display session message --}}
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card-body">
                        <ul class="list-group">
                           <table>
                                    <thead>
                                        <th style="width:10%" >ID du Client</th>
                                        <th style="width:65%" >Nom du client</th>
                                        <th style="width:25%" >Action</th>
                                    </thead>
                                    <tbody>
                                        {{-- Data fetched from API --}}
                                        @foreach ($clients as $client)
                                   
                                        <tr>
                                            <td>{{$client['id']}}</td>
                                            <td>{{$client['client_name']}}</td>
                                            <td>
                                                <form action="{{route('delete-client',$client['id'])}}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                         @endforeach
                                    </tbody>
                            </table>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{route('client.create')}}">Ajouter nouveau client</a>
            </div>
        </div>
    </div>
@endsection