@extends('layouts.layout')
@section('content')

<div class="container">
    <div class="col-md-12">
        <h1 class="text-center">Creer un Bulletin de Salaire</h1>
    </div>
    <div class="row">
        <div class="col-md-12 p-4">
            <form action="{{route('update',$wageslip->id)}}" method="POST">
                @method('PUT')
                @csrf
                <label for="matricule" class="form-label">Matricule:</label>
                <input type="text" id="matricule" class="form-control" name="matricule" value="{{ $wageslip->matricule }}" required><br>

                <label for="salaire_de_base" class="form-label">Salaire de Base:</label>
                <input type="number" id="salaire_de_base" class="form-control" name="salaire_de_base" value="{{ $wageslip->salaire_de_base }}" required><br>

                <label for="heures_supplementaires" class="form-label">Heures Supplementaires:</label>
                <input type="number" id="heures_supplementaires" class="form-control" name="heures_supplementaires" value="{{ $wageslip->heures_supplementaires }}"><br>

                <label for="prime_de_salissure" class="form-label">Prime de Salissure:</label>
                <input type="number" id="prime_de_salissure" class="form-control" name="prime_de_salissure" value="{{ $wageslip->prime_de_salissure }}"><br>

                <label for="prime_annuelle" class="form-label">Prime Annuelle:</label>
                <input type="number" id="prime_annuelle" class="form-control" name="prime_annuelle" value="{{ $wageslip->prime_annuelle }}"><br>

                <label for="avance_sur_salaire" class="form-label">Avance sur Salaire:</label>
                <input type="number" id="avance_sur_salaire" class="form-control" name="avance_sur_salaire" value="{{ $wageslip->avance_sur_salaire }}"><br>

                <label for="assurance_maladie" class="form-label">Assurance Maladie:</label>
                <input type="number" id="assurance_maladie" class="form-control" name="assurance_maladie" value="{{ $wageslip->assurance_maladie }}"><br>

                <label for="assurance_accident_de_travail" class="form-label">Assurance Accident de Travail:</label>
                <input type="number" id="assurance_accident_de_travail" class="form-control" name="assurance_accident_de_travail" value="{{ $wageslip->assurance_accident_de_travail }}"><br>

                <label for="nationalite" class="form-label">Nationalité:</label>
                <input type="text" id="nationalite" class="form-control" name="nationalite" value="{{ $wageslip->nationalite }}" required><br>

                <label for="nom_employee" class="form-label">Nom Employee:</label>
                <input type="text" id="nom_employee" class="form-control" name="nom_employee" value="{{ $wageslip->nom_employee }}" required><br>

                {{-- <label for="periode_de_paie" class="form-label">Période de Paie:</label> --}}
                <input type="hidden" id="periode_de_paie" class="form-control" name="periode_de_paie" value="{{ $wageslip->periode_de_paie }}" required><br>

                {{-- <label for="date_de_paie" class="form-label">Date de Paie:</label> --}}
                <input type="hidden" id="date_de_paie" class="form-control" name="date_de_paie" value="{{ $wageslip->date_de_paie }}" required><br>
                <label for="add_employee" class="form-label">Adresse Employee:</label>
                <input type="text" id="add_employee" class="form-control" name="add_employee" value="{{ $wageslip->add_employee }}" required><br>


                {{-- <label for="date_de_debut" class="form-label">Date de Début:</label> --}}
                <input type="hidden" id="date_de_debut" class="form-control" name="date_de_debut" value="{{ $wageslip->date_de_debut }}" required><br>

                {{-- <label for="date_de_fin" class="form-label">Date de Fin:</label> --}}
                <input type="hidden" id="date_de_fin" class="form-control" name="date_de_fin" value="{{ $wageslip->date_de_fin }}" required><br>

                <label for="emploi" class="form-label">Emploi:</label>
                <input type="text" id="emploi" class="form-control" name="emploi" value="{{ $wageslip->emploi }}" required><br>

                <label for="anciennete" class="form-label">Ancienneté:</label>
                <input type="date" id="anciennete" class="form-control" name="anciennete" value="{{ $wageslip->anciennete }}" required><br>

                {{-- <label for="taxe" class="form-label">Taxe:</label> --}}
                <input type="hidden" id="taxe" class="form-control" name="taxe" value="{{ $wageslip->taxe }}"><br>

                <button type="submit" class="form-control">Sauvegarder</button>
            </form>
        </div>
    </div>
</div>
@endsection