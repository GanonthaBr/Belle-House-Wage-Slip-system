<!-- filepath: /c:/Users/DELL/Desktop/work files/BelleHouse/bulletin-salaire/resources/views/invoices/create.blade.php -->
@extends('layouts.layout')
@section('content')
<div class="container">
    <h1>Create Invoice</h1>
    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="client_id">Client Id</label>
            <input type="number" class="form-control" id="client_id" name="client_id" required>
        </div>    
        <div class="form-group">
            <label for="topic">Object</label>
            <input type="text" class="form-control" placeholder="Object de la facture" id="topic" name="topic" required>
        </div>
        <fieldset>
        <div class="form-check">
            <label for="facture" class="form-label"> <b>Type de Facture:</b> </label> <br>
            <input class="form-check-input" type="radio" name="facture_type" id="facture" value="Facture">
            <label class="form-check-label" for="facture"> Facture</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="facture_type" id="Devis" value="Facture Proforma" checked>
            <label class="form-check-label" for="Devis">Facture Proforma</label>
        </div>
        </fieldset>
        <div class="form-group">
            <label for="echeance">Echéance de paiement</label>
            <input type="date" class="form-control" id="echeance" name="echeance" required>
        </div>
        
        <div class="form-group">
            <label for="montant_avanc">Montant Avance</label>
            <input type="text" class="form-control" id="montant_avanc" name="montant_avanc">
        </div>
        <fieldset>
            <div class="form-check">
                <label for="tax" class="form-label"> <b>Section Taxe</b> </label> <br>
                <input type="radio" id="tax_oui" name="tax" class="form-check-input" value="oui" required>
                <label class="form-check-label" for="tax_oui">OUI</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tax" id="tax_non" value="non" checked>
                <label class="form-check-label" for="tax_non">NON</label>
            </div>
        </fieldset>
        <fieldset id="typeTaxFieldset">
            <label for="type_tax" class="form-label"> <b>Type de Taxe</b> </label> <br>
            <div class="form-check">
                <input type="radio" id="tva" name="type_tax" class="form-check-input" value="TVA" checked required>
                <label class="form-check-label" for="tva">TVA</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type_tax" id="isb" value="ISB" required>
                <label class="form-check-label" for="isb">ISB</label>
            </div>
        </fieldset>
        <fieldset>
            <label for="payment_mode" class="form-label"> <b>Mode de Paiement</b> </label> <br>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_mode" id="en_liquide" value="En ESPÈCES">
                <label class="form-check-label" for="en_liquide"> En ESPÈCES</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_mode" id="par_banque" value="PAR VERSEMENT">
                <label class="form-check-label" for="par_banque"> PAR VERSEMENT</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_mode" id="par_banque" value="PAR CHEQUE" checked>
                <label class="form-check-label" for="par_banque"> PAR CHEQUE</label>
            </div>
        </fieldset>
        <fieldset>
            <legend>Liste des Elements</legend>
            <div id="itemFieldsContainer">
                <div class="itemField">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="designation_title[]" placeholder="Designation" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="designation_details[]" placeholder="Bref details Details" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" name="designation_quantity[]" placeholder="Quantity" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" name="designation_unit_price[]" placeholder="Prix Unitaire" required>
                    </div>
                    <button type="button" onclick="removeItemField(this)">Retirer</button>
                </div>
            </div>
            <button type="button" id="addItemField">Ajouter un Element</button>
        </fieldset>
        <!-- Add other fields as necessary -->
        <button type="submit" class="btn btn-primary">Create Invoice</button>
    </form>
</div>
<script>
    //Tax
    document.addEventListener('DOMContentLoaded', function() {
        const taxOui = document.getElementById('tax_oui');
        const taxNon = document.getElementById('tax_non');
        const typeTaxFieldset = document.getElementById('typeTaxFieldset');

        function toggleTypeTaxFieldset() {
            if (taxOui.checked) {
                typeTaxFieldset.style.display = 'block';
            } else {
                typeTaxFieldset.style.display = 'none';
            }
        }

        taxOui.addEventListener('change', toggleTypeTaxFieldset);
        taxNon.addEventListener('change', toggleTypeTaxFieldset);
        toggleTypeTaxFieldset(); // Initial check
    });
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