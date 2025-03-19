<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bulletin de Salaire</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f8f8f8;
            padding: 20px;
        }

        .salary-slip {
            width: 80%;
            margin: auto;
            background: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
            color: #61a1d6;
        }

        header h2 {
            margin-bottom: 5px;
        }

        .employee-details,
        .summary {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: rgba(97, 161, 214, 0.29);
            font-weight: bold;
        }

        .rubrique {
            text-align: left;
        }

        .break-point {
            background-color: rgba(143, 177, 205, 0.08);
        }

        .summary .net-pay {
            text-align: right;
            color: green;
        }

        .salary-slip__actions {
            width: 35%;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .salary-slip__actions a {
            text-decoration: none;
            color: #fff;
            background-color: #61a1d6;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .salary-slip__actions a:nth-last-of-type(1) {
            background-color: #087c5f81;

        }

        .salary-slip__actions a:nth-child(1) {
            background-color: #f00;
        }

        .salary-slip__actions a:hover {
            background-color: #08c661;
        }


        footer {
            margin-top: 10px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }

        .invoice footer {

            width: 100%;

            text-align: center;

            color: #777;

            border-top: 1px solid #aaa;

            padding: 5px 0;

        }

        footer span {

            font-size: 10px;

        }
    </style>
</head>
{{-- @php
// Arithmetic operations

// EXTRA HOURS
$rate_extra_hours = 0.05 * $wageslip->salaire_de_base;
$extra_hours = $rate_extra_hours * $wageslip->heures_supplementaires;

// TOTAL
$total = $wageslip->salaire_de_base + $extra_hours + $wageslip->prime_de_salissure + $wageslip->prime_annuelle;

// TAX
$tax_rate = $wageslip->taxe / 100;
$tax = $wageslip->taxe / 100 * $total;

// NET IMPOSABLE
$net_imposable = $wageslip->assurance_maladie + $wageslip->assurance_accident_de_travail + $tax + $wageslip->avance_sur_salaire;

// NET PAY
$net_pay = $total - $net_imposable;


@endphp --}}
@php
// Arithmetic operations

// Avantage en Nature
$adds_on = $wageslip->heures_supplementaires;
$charges = $wageslip->assurance_accident_de_travail;
$cnss = 0.0525 * ($wageslip->salaire_de_base  + $wageslip->prime_annuelle);//CNSS

// RBG (Revenues Brutes Globale)
$RBG = $wageslip->salaire_de_base  + $wageslip->prime_annuelle - $cnss + $adds_on;
$total = $wageslip->salaire_de_base  + $wageslip->prime_annuelle + $adds_on;
// RBGI (Revenues Brutes Gloables Imposables)
$abattement = 0.1 * $RBG; //10 % du RBG Abattement professionels
$RBGI = $RBG - $abattement;
// RNI (Revenues Nettes Imposables)
    $RNI = $RBGI;
$assurance_maladie = $wageslip->assurance_accident_de_travail;
$charge_taux = 0;
if($assurance_maladie==0){
    $charge_taux = 0;
}elseif($assurance_maladie==1){
    $charge_taux = 0.05 * $RBGI;
}elseif($assurance_maladie==2){
    $charge_taux =  0.10 * $RBGI;
}elseif($assurance_maladie==3){
    $charge_taux =  0.12 * $RBGI;
}elseif($assurance_maladie==4){
    $charge_taux =  0.13 * $RBGI;
}elseif($assurance_maladie==5){
    $charge_taux= 0.14 * $RBGI;
}elseif($assurance_maladie==6){
    $charge_taux =  0.15 * $RBGI;
}elseif($assurance_maladie==7){
    $charge_taux = 0.3 * $RBGI;
}
$RNI = $RBGI - $charge_taux;

// IUTS (TAXES)
function calculate_ITS($RNI) {
    if ($RNI <= 25000) {
        return 250;
    } elseif ($RNI <= 50000) {
        return 250 + 0.02 * ($RNI - 25000);
    } elseif ($RNI <= 100000) {
        return 250 + 500 + 0.06 * ($RNI - 50000);
    } elseif ($RNI <= 150000) {
        return 250 + 500 + 3000 + 0.13 * ($RNI - 100000);
    } else {
        return 250 + 500 + 3000 + 6500 + 0.25 * ($RNI - 150000);
    }
}
$tax_rate = 0;
if($RNI<=25000){
    $tax_rate = 0.1;
}elseif($RNI <= 50000){
    $tax_rate = 0.02;
}elseif($RNI <= 100000){
    $tax_rate = 0.06;
}elseif($RNI <= 150000){
    $tax_rate = 0.13;
}else{
    $tax_rate = 0.25;
}
$ITS = calculate_ITS($RNI);

// dd($charge_taux);

// NET IMPOSABLE
$net_imposable = $cnss + $ITS + $charge_taux + $wageslip->avance_sur_salaire + $abattement;

// NET PAY
$net_pay = $RNI - $ITS;



@endphp
<body>
    <div class="salary-slip">
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        {{-- section with action buttons --}}
        <div class="salary-slip__header">
            <div class="salary-slip__actions">
                <a href="{{route('home')}}">Retour</a> <br>
                <a href="{{route('wageslip.downloadPDF',$wageslip->id)}}">Telecharger PDF</a> <br>
                <a href="{{route('edit',$wageslip->id)}}" class="btn btn-primary">Modifier</a>
            </div>
        </div>

        <header>
            <div class="company-details">
                <h2>BELLE HOUSE</h2>
                <p>Entreprise de Construction Moderne</p>
                <p>Niamey - Niger</p>
                <p>Quuartier Koubie</p>
                <p>NIF: 80903771800022 | RCCM: RCCM-NE-NIM-01-2017-A10-02845</p>
            </div>
            <div class="pay-period">
                <h2>BULLETIN DE SALAIRE</h2>
                <p><strong>Mois :</strong>{{$wageslip->periode_de_paie}} </p>
                <p><strong>Période :</strong>Du {{$wageslip->date_de_debut}} Au {{$wageslip->date_de_fin}} </p>
                <p><strong>Date Paiement :</strong> {{$wageslip->date_de_paie}}</p>
            </div>
        </header>

        <section class="employee-details">
            <div>
                <p><strong>Nom :</strong> {{$wageslip->nom_employee}} </p>
                <p><strong>Adresse :</strong> {{$wageslip->add_employee}}</p>
                <p><strong>Emploi :</strong> {{$wageslip->emploi}} </p>
            </div>
            <div>
                <p><strong>Matricule :</strong> {{$wageslip->matricule}}</p>
                {{-- <p><strong>Entrée :</strong>{{$wageslip->date_de_paie}} </p> --}}
                <p><strong>Telephone :</strong>{{$wageslip->employee_phone}} </p>
            </div>
        </section>

         <section class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>Rubriques</th>
                        <th>Base</th>
                        <th>Taux Salarial</th>
                        <th>Montant Salarial</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="rubrique">SALAIRE DE BASE</td>
                        <td>{{$wageslip->salaire_de_base}}</td>
                        <td>-</td>
                        <td>{{$wageslip->salaire_de_base}}</td>
                    </tr>
                    <tr>
                        <td class="rubrique">Avantages en Natures</td>
                        <td>{{$wageslip->heures_supplementaires}}</td>
                        <td> - </td>
                        <td> {{$wageslip->heures_supplementaires}}</td>
                    </tr>
                    {{-- <tr>
                        <td class="rubrique">Prime de Salissure</td>
                        <td>{{$wageslip->prime_de_salissure}}</td>
                        <td>-</td>
                        <td>{{$wageslip->prime_de_salissure}}</td>
                    </tr> --}}
                    <tr>
                        <td class="rubrique">Prime</td>
                        <td>{{$wageslip->prime_annuelle}}</td>
                        <td>-</td>
                        <td>{{$wageslip->prime_annuelle}}</td>
                    </tr>
                    <tr class="break-point">
                        <td class="rubrique">SALAIRE BRUT TOTAL</td>
                        <td>-</td>
                        <td>-</td>
                        <td><strong> {{$total}} </strong></td>
                    </tr>
                    <tr>
                        <td class="rubrique">Avance sur Salaire</td>
                        <td>{{$wageslip->avance_sur_salaire}}</td>
                        <td>-</td>
                        <td>{{$wageslip->avance_sur_salaire}}</td>
                    </tr>
                    <tr>
                        <td class="rubrique">Charges de Famille</td>
                        <td>{{$wageslip->assurance_accident_de_travail}}</td>
                        <td>-</td>
                        <td>{{$charge_taux}}</td>
                    </tr>
                    <tr>
                        <td class="rubrique">Abattement Charges Professionelles</td>
                        <td>10 % du RBG</td>
                        <td>-</td>
                        <td>{{$abattement}}</td>
                    </tr>
                    <tr>
                        <td class="rubrique">Contribution CNSS</td>
                        <td>-</td>
                        <td>-</td>
                        <td>{{$cnss}}</td>
                    </tr>
                    <tr>
                        <td class="rubrique">Impôts sur les Traitements et Salaire </td>
                        <td>{{$tax_rate * 100}}%</td>
                        <td>{{$tax_rate}}</td>
                        <td>{{$ITS}}</td>
                    </tr>
                    <tr class="break-point">
                        <td class="rubrique">NET IMPOSABLE</td>
                        <td>-</td>
                        <td>-</td>
                        <td><strong> {{$net_imposable}} </strong></td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section class="summary">
            <div>
                <p><strong>Total des Retenues :</strong> {{$total}} FCFA</p>
                <p><strong>Total des Cotisations Patronales :</strong> {{$net_imposable}} FCFA</p>
            </div>
            <div class="net-pay">
                <h3>NET À PAYER :</h3>
                <h2> {{$net_pay}} FCFA</h2>
            </div>
        </section>

        <footer>
            <span> Compte Ecobank: <b class="black-footer">160940732001</b> Compte Orabank: <b class="black-footer">76495401901 </b>Compte BIA: <b class="black-footer">61001260006</b> Compte BOA: <b class="black-footer">004404430009</b> </span> <br>
            <b class="black-footer"> RCCM-NE-NIM-01-2017-A10-02845- NIF : 43391/P.</b>
        </footer>
    </div>
</body>

</html>