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
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="invoice_name">Invoice Name</label>
            <input type="text" class="form-control" id="invoice_name" name="invoice_name" required>
        </div>
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
                    <button type="button" onclick="removeItemField(this)">Remove</button>
                </div>
            </div>
            <button type="button" id="addItemField">Ajouter un Element</button>
            </fieldset>
        <!-- Add other fields as necessary -->
        <button type="submit" class="btn btn-primary">Creer Invoice</button>
    </form>
</div>
<script>

        document.getElementById('addItemField').addEventListener('click', function() {

            const container = document.getElementById('itemFieldsContainer');

            const newItemField = document.createElement('div');

            newItemField.classList.add('itemField');

            newItemField.innerHTML = `

       <div class="mb-3">

                            <input type="text" class="form-control" name="itemNames[]" placeholder="Designation" required>

                        </div>

                        <div class="mb-3">

                            <input type="text" class="form-control" name="itemDetails[]" placeholder="Bref details Details">

                        </div>

                        <div class="mb-3">

                            <input type="number" class="form-control" name="itemQuantities[]" placeholder="Quantity" required>

                        </div>

                        <div class="mb-3">

                            <input type="number" class="form-control" name="itemPrices[]" placeholder="Prix Unitaire" required>

                        </div>

        <button type="button" onclick="removeItemField(this)">Remove</button>

    `;

            container.appendChild(newItemField);

        });



        function removeItemField(button) {

            button.parentElement.remove();

        }

    </script>
@endsection