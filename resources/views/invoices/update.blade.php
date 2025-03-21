@extends('layouts.layout')
@section('content')
<div class="container">
    
    <h1>Modification de la Facture BH/{{$invoice['number']}}</h1>
    <form action="{{ route('invoice.update',$invoice['id']) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="client_id">Client Id</label>
            <input type="number" class="form-control" id="client_id" name="client_id" value="{{$invoice['id']}}" required>
        </div>    
        <div class="form-group">
            <label for="topic">Object</label>
            <input type="text" class="form-control" placeholder="Object de la facture" id="topic" name="topic" value="{{$invoice['topic']}}" required>
        </div>
        <fieldset>
        <div class="form-check">
            <label for="facture" class="form-label"> <b>Type de Facture:</b> </label> <br>
            <input class="form-check-input" type="radio" name="facture_type" id="facture" value="Facture" {{ $invoice['name'] == 'Facture' ? 'checked' : '' }}>
            <label class="form-check-label" for="facture"> Facture</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="facture_type" id="Devis" value="Facture Proforma" {{ $invoice['name'] == 'Facture Proforma' ? 'checked' : '' }}>
            <label class="form-check-label" for="Devis">Facture Proforma</label>
        </div>
        </fieldset>
        <div class="form-group">
            <label for="echeance">Echéance de paiement</label>
            <input type="date" class="form-control" id="echeance" name="echeance" value="{{$invoice['echeance']}}" required>
        </div>
        
        <div class="form-group">
            <label for="montant_avanc">Montant Avance</label>
            <input type="text" class="form-control" id="montant_avanc" name="montant_avanc" value="{{$invoice['montant_avance']}}" >
        </div>
        <fieldset>
            <div class="form-check">
                <label for="tax" class="form-label"> <b>Section Taxe</b> </label> <br>
                <input type="radio" id="tax_oui" name="tax" class="form-check-input" value="oui" {{ $invoice['tax'] == 'oui' ? 'checked' : '' }} required>
                <label class="form-check-label" for="tax_oui">OUI</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tax" id="tax_non" value="non" {{ $invoice['tax'] == 'non' ? 'checked' : '' }} >
                <label class="form-check-label" for="tax_non">NON</label>
            </div>
        </fieldset>
        <fieldset id="typeTaxFieldset">
            <label for="type_tax" class="form-label"> <b>Type de Taxe</b> </label> <br>
            <div class="form-check">
                <input type="radio" id="tva" name="type_tax" class="form-check-input" value="TVA" {{ $invoice['type_tax'] == 'TVA' ? 'checked' : '' }}  required>
                <label class="form-check-label" for="tva">TVA</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type_tax" id="isb" value="ISB" {{ $invoice['type_tax'] == 'ISB' ? 'checked' : '' }} required>
                <label class="form-check-label" for="isb">ISB</label>
            </div>
        </fieldset>
        <fieldset>
            <label for="payment_mode" class="form-label"> <b>Mode de Paiement</b> </label> <br>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_mode" id="en_liquide" value="En ESPÈCES" {{ $invoice['payment_mode'] == 'En ESPÈCES' ? 'checked' : '' }}>
                <label class="form-check-label" for="en_liquide"> En ESPÈCES</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_mode" id="par_banque" value="PAR VERSEMENT" {{ $invoice['payment_mode'] == 'PAR VERSEMENT' ? 'checked' : '' }}>
                <label class="form-check-label" for="par_banque"> PAR VERSEMENT</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_mode" id="par_banque" value="PAR CHEQUE" {{ $invoice['payment_mode'] == 'PAR CHEQUE' ? 'checked' : '' }}>
                <label class="form-check-label" for="par_banque"> PAR CHEQUE</label>
            </div>
        </fieldset>
        <fieldset>
            <legend>Liste des Elements</legend>
            <div id="itemFieldsContainer">
                @foreach($invoice['designations'] as $designation)
                <div class="itemField">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="designation_title[]" placeholder="Designation" value="{{$designation['designation_title']}}" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="designation_details[]" placeholder="Bref details Details" value="{{$designation['designation_details']}}" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" name="designation_quantity[]" placeholder="Quantity" value="{{$designation['designation_quantity']}}" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" name="designation_unit_price[]" placeholder="Prix Unitaire" value="{{$designation['designation_unit_price']}}" required>
                    </div>
                    <button type="button" onclick="removeItemField(this)">Retirer</button>
                </div>
                @endforeach
            </div>
            <button type="button" id="addItemField">Ajouter un Element</button>
        </fieldset>
        <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
    </form>
</div>
<script>
    //Tax
    // document.addEventListener('DOMContentLoaded', function() {
    //     const taxOui = document.getElementById('tax_oui');
    //     const taxNon = document.getElementById('tax_non');
    //     const typeTaxFieldset = document.getElementById('typeTaxFieldset');

    //     function toggleTypeTaxFieldset() {
    //         if (taxOui.checked) {
    //             typeTaxFieldset.style.display = 'block';
    //         } else {
    //             typeTaxFieldset.style.display = 'none';
    //         }
    //     }

    //     taxOui.addEventListener('change', toggleTypeTaxFieldset);
    //     taxNon.addEventListener('change', toggleTypeTaxFieldset);
    //     toggleTypeTaxFieldset(); // Initial check
    // });
    //Items
    document.getElementById('addItemField').addEventListener('click', function() {

        const container = document.getElementById('itemFieldsContainer');

        const newItemField = document.createElement('div');

        newItemField.classList.add('itemField');

        newItemField.innerHTML = `

       <div class="mb-3">
            <input type="text" class="form-control" name="designation_title[]" placeholder="Designation" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="designation_details[]" placeholder="Bref details Details">
        </div>
        <div class="mb-3">
            <input type="number" class="form-control" name="designation_quantity[]" placeholder="Quantity" required>
        </div>
        <div class="mb-3">
            <input type="number" class="form-control" name="designation_unit_price[]" placeholder="Prix Unitaire" required>
        </div>
        <button type="button" onclick="removeItemField(this)">Retirer</button>
    `;
        container.appendChild(newItemField);
    });

    function removeItemField(button) {
        button.parentElement.remove();

    }
</script>
@endsection