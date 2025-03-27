@extends('layouts.layout')
@section('content')

<div class="container">
    <div class="col-md-12">
        <h1 class="text-center">Ajouter un Nouveau Client</h1>
        {{-- show session message --}}
            @if (session('error'))    
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif  
    </div>
    <div class="row">
        <div class="col-md-12 p-4">
            <form action="{{route('client.store')}}" method="POST" id="wageslip-form">
                @csrf
                <label for="client_name" class="form-label">Nom du client:</label>
                <input type="text" id="client_name" class="form-control" name="client_name" required ><br>

                <label for="client_quartier" class="form-label">Quartier:</label>
                <input type="number" id="client_quartier" class="form-control" name="client_quartier" required><br>

                <label for="client_country" class="form-label">Pays:</label>
                <input type="number" id="client_country" class="form-control" name="client_country"><br>

                
                <label for="client_city" class="form-label">Ville:</label>
                <input type="number" id="client_city" class="form-control" name="client_city"><br>

                <label for="client_phone" class="form-label">Numero de Telephone:</label>
                <input type="number" id="client_phone" class="form-control" name="client_phone"><br>

                
                <label for="client_mail" class="form-label">Email:</label>
                <input type="number" id="client_mail" class="form-control" name="client_mail"><br>

        
                <button type="submit" class="form-control">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection