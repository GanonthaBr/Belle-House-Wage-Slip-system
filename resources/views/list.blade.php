@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Liste de tous les Bulletins de salaire</div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @elseif(session('message'))
                            <div class="alert alert-warning">
                                {{ session('message') }}
                            </div>    
                        
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nom Employee</th>
                                    <th scope="col">Matricule</th>
                                    <th scope="col">Période de Paie</th>
                                    
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wageslips as $wageslip)
                                    <tr>
                                        <td>{{ $wageslip->nom_employee }}</td>
                                        <td>{{ $wageslip->matricule }}</td>
                                        <td>{{ $wageslip->periode_de_paie }}</td>
                                        
                                        <td class="salary-slip__actions">
                                            <a href="{{route('wageslip.downloadPDF',$wageslip->id)}}" class="btn btn-primary btn-sm">Telecharger</a>
                                            <a href="{{ route('edit', $wageslip->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="{{ route('delete', $wageslip->id) }}" method="POST" style="display: inline-block;">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection