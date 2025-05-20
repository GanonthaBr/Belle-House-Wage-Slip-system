@extends('layouts.layout')
@section('content')

<div class="container">
    <div class="col-md-12">
        <h1 class="text-center">Ajouter un Nouveau Salarie</h1>
        {{-- show session message --}}
            @if (session('error'))    
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif  
    </div>
    {{-- 
                        
                         "employee_id" => "15"
    "first_name" => "Abdel"
    "last_name" => "Mahamane"
    "email" => "eldykiam.dev@gmail.com"
    "phone_number" => "+22789853603"
    "hire_date" => "2024-12-12"
    "employee_address" => "Goudel"
    "job_title" => "Architect"
    "base_salary" => "42000.00"
    "employee_nationality" => "CAR"
                        --}}
    <div class="row">
        <div class="col-md-12 p-4">
            <form action="{{route('employees.store')}}" method="POST">
                @csrf
                <label for="employee_id" class="form-label">ID:</label>
                <input type="text" id="employee_id" class="form-control" name="employee_id"  ><br>
                <label for="first_name" class="form-label">Nom:</label>
                <input type="text" id="first_name" class="form-control" name="first_name"  ><br>

                <label for="last_name" class="form-label">Prenom:</label>
                <input type="text" id="last_name" class="form-control" name="last_name"  ><br>

                <label for="employee_address" class="form-label">Quartier:</label>
                <input type="text" id="employee_address" class="form-control" name="employee_address" ><br>

                <label for="employee_nationality" class="form-label">Pays:</label>
                <input type="text" id="employee_nationality" class="form-control" name="employee_nationality"><br>

                
                <label for="hire_date" class="form-label">Annee d'embauche:</label>
                <input type="date" id="hire_date" class="form-control" name="hire_date"><br>

                <label for="job_title" class="form-label">Position:</label>
                <input type="text" id="job_title" class="form-control" name="job_title"><br>

                <label for="phone_number" class="form-label">Numero de Telephone:</label>
                <input type="text" id="phone_number" class="form-control" name="phone_number"><br> 

                <label for="base_salary" class="form-label">Salaire de base:</label>
                <input type="number" id="base_salary" class="form-control" name="base_salary"><br>

                
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" class="form-control" name="email"><br>
        
                <button type="submit" class="form-control">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection