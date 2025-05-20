@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{-- show session message --}}
            @if (session('success'))    
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif 
                <div class="card">
                    <div class="card-title">
                        <h1 class="text-center">Employees</h1>
                    </div>
                    <div class="card-body">
                        @if ($employees)
                            
                        
                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom & Prenom</th>
                                    <th>Telephone</th>
                                    <th>Email</th>
                                    <th>Position</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $employee['employee_id'] }}</td>
                                    <td>{{ $employee['first_name'] }} {{ $employee['last_name'] }}</td>
                                    <td>{{$employee['phone_number']}}</td>
                                    <td>{{$employee['email']}}</td>
                                    <td>{{$employee['job_title']}}</td>
                                    <td>
                                        <form action="{{route('employees.delete',$employee['id'])}}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>  
                                @endforeach                   
                            </tbody>
                        </table>
                        @else
                        <p class="text-center">Aucun employé trouvé</p>
                        @endif
                    </div>
                    <div>
                        <a href="{{route('employees.create')}}" class="btn btn-outline-success" >Ajouter un nouveau</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection