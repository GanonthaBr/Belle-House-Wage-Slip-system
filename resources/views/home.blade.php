@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Dashboard Belle House</h1>
            {{-- show session message --}}
            @if (session('error'))    
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif        
            <div class="row">
                <div class="col-md-6">
                    <div class="card half-screen">
                        <div class="card-body">
                            <h5 class="card-title">
                                Gestion des Employees
                            </h5>
                            {{-- list of employees. Just the html without the data, we will the data from js with external API call --}}
                            <ul class="list-group employees-last-3">
                                {{-- Data fetched from API --}}
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
                                        <a href="{{route('show',$wageslip->id)}}" class="btn btn-primary btn-sm">Voir</a>
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
                        <div class="card-body">
                            <h5 class="card-title">Invoice</h5>
                            <p class="card-text">List of all invoices</p>
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim, ipsam! Velit quasi quo sed perspiciatis ipsum officiis, ex cum! Nisi, debitis fuga, aliquid autem nostrum neque consequatur aut, sequi illum dignissimos eius quibusdam nemo non. Eveniet molestiae culpa, praesentium corrupti nemo aperiam eos atque dolor voluptates, sit ut fugit molestias nobis, quisquam eligendi expedita. Ratione aperiam, soluta amet deleniti expedita nobis tempore facilis voluptatibus! Vel harum fuga repellendus ut. Reiciendis ipsam dolores dolorum dolore est unde asperiores ipsa quis, repudiandae dignissimos perferendis iste, hic numquam adipisci impedit iure repellat quidem? Ipsam explicabo facere doloribus. Sint dignissimos dolor doloremque eligendi sit.
                            </p>
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim, ipsam! Velit quasi quo sed perspiciatis ipsum officiis, ex cum! Nisi, debitis fuga, aliquid autem nostrum neque consequatur aut, sequi illum dignissimos eius quibusdam nemo non. Eveniet molestiae culpa, praesentium corrupti nemo aperiam eos atque dolor voluptates, sit ut fugit molestias nobis, quisquam eligendi expedita. Ratione aperiam, soluta amet deleniti expedita nobis tempore facilis voluptatibus! Vel harum fuga repellendus ut. Reiciendis ipsam dolores dolorum dolore est unde asperiores ipsa quis, repudiandae dignissimos perferendis iste, hic numquam adipisci impedit iure repellat quidem? Ipsam explicabo facere doloribus. Sint dignissimos dolor doloremque eligendi sit.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection