<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<body>
    <div class="salary-slip">
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
                <p><strong>Période :</strong>Du {{$wageslip->date_de_debut}} Au {{$wageslip->date_de_fin}}  </p>
                <p><strong>Paiement :</strong> {{$wageslip->date_de_paie}}</p>
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
                <p><strong>Entrée :</strong>{{$wageslip->date_de_paie}} </p>
                <p><strong>Telephone :</strong>{{$wageslip->empl_phone}} </p>
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
                        <td>10.4000</td>
                        <td>1577.37</td>

                    </tr>
                    <tr>
                        <td class="rubrique">Heures supplémentaires 25%</td>
                        <td>{{$wageslip->heures_supplementaires}}</td>
                        <td>13.0000</td>
                        <td>279.50</td>

                    </tr>
                    <tr>
                        <td class="rubrique">Prime de Salissure</td>
                        <td>{{$wageslip->prime_de_salissure}}</td>
                        <td>15.6000</td>
                        <td>15.60</td>

                    </tr>
                    <tr>
                        <td class="rubrique">Prime Annuelle</td>
                        <td>{{$wageslip->prime_annuelle}}</td>
                        <td>15.6000</td>
                        <td>15.60</td>

                    </tr>

                    <tr class="break-point">
                        <td class="rubrique">SALAIRE BRUT TOTAL</td>
                        <td>-</td>
                        <td>-</td>
                        <td><strong>2124.10</strong></td>

                    </tr>
                    <tr>
                        <td class="rubrique">Avance sur Salaire</td>
                        <td>{{$wageslip->avance_sur_salaire}}</td>
                        <td>10.4000</td>
                        <td>1577.37</td>

                    </tr>
                    <tr>
                        <td class="rubrique">Assurance Maladie</td>
                        <td>{{$wageslip->assurance_maladie}}</td>
                        <td>13.0000</td>
                        <td>279.50</td>

                    </tr>
                    <tr>
                        <td class="rubrique">Assurance Accident de Travail</td>
                        <td>{{$wageslip->assurance_accident_de_travail}}</td>
                        <td>15.6000</td>
                        <td>15.60</td>

                    </tr>
                    <tr>
                        <td class="rubrique">Taxe</td>
                        <td>{{$wageslip->taxe}}</td>
                        <td>15.6000</td>
                        <td>15.60</td>

                    </tr>
                    <tr class="break-point">
                        <td class="rubrique">NET IMPOSABLE</td>
                        <td>-</td>
                        <td>-</td>
                        <td><strong>2124.10</strong></td>

                    </tr>
                </tbody>
            </table>
        </section>

        <section class="summary">
            <div>
                <p><strong>Total des Retenues :</strong> 1111.16</p>
                <p><strong>Total des Cotisations Patronales :</strong> 627.59</p>
            </div>
            <div class="net-pay">
                <h3>NET À PAYER :</h3>
                <h2>1562.65 FCFA</h2>
            </div>
        </section>

        <footer>
            <span> Compte Ecobank: <b class="black-footer">160940732001</b> Compte Orabank: <b class="black-footer">76495401901 </b>Compte BIA: <b class="black-footer">61001260006</b> Compte BOA: <b class="black-footer">004404430009</b> </span> <br>
            <b class="black-footer"> RCCM-NE-NIM-01-2017-A10-02845- NIF : 43391/P.</b>
        </footer>
    </div>
</body>

</html>