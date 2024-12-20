<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bulletin de Salaire</title>
</head>
<style>
    .half-screen {
        height: 50vh;
    }
</style>

<body>
    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{asset('images/logo.png')}}" alt="logo" height="100">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create') }}">Creer un bulletin de salaire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list') }}">Liste des bulletins de salaire</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end nav bar -->
    @yield('content')

    {{-- link js code code.js --}}
    <script>
        var url = "https://bellehouse.pythonanywhere.com/api/employees/";
        // filepath: /c:/Users/DELL/Desktop/work files/BelleHouse/bulletin-salaire/public/code.js

        async function fetchEmployeeData() {
            const matricule = document.getElementById("matricule").value;
            if (matricule.length === 0) {
                return;
            }
            const url = `https://bellehouse.pythonanywhere.com/api/employees/${matricule}`;

            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                const data = await response.json();
                console.log(data);
                document.getElementById("salaire_de_base").value =
                    data.base_salary || "";
                document.getElementById("heures_supplementaires").value =
                    data.heures_supplementaires || "";
                document.getElementById("prime_de_salissure").value =
                    data.prime_de_salissure || "";
                document.getElementById("prime_annuelle").value =
                    data.prime_annuelle || "";
                document.getElementById("avance_sur_salaire").value =
                    data.avance_sur_salaire || "";
                document.getElementById("assurance_maladie").value =
                    data.assurance_maladie || "";
                document.getElementById("assurance_accident_de_travail").value =
                    data.assurance_accident_de_travail || "";
                document.getElementById("nationalite").value =
                    data.employee_nationality || "";
                document.getElementById("nom_employee").value = data.first_name + ' ' + data.last_name || "";
                document.getElementById("add_employee").value = data.employee_address || "";
                document.getElementById("periode_de_paie").value =
                    data.periode_de_paie || "";
                document.getElementById("date_de_paie").value = data.date_de_paie || "";
                document.getElementById("date_de_debut").value =
                    data.date_de_debut || "";
                document.getElementById("date_de_fin").value = data.date_de_fin || "";
                document.getElementById("emploi").value = data.job_title || "";
                document.getElementById("anciennete").value = data.hire_date || "";
                document.getElementById("taxe").value = data.taxe || "";
            } catch (error) {
                document.getElementById('wageslip-form').reset();
                //reset the form except the matricule field
                document.getElementById("matricule").value = matricule;
                // console.error("Error fetching employee data:", error);
            }
        }
        // 
    </script>
</body>

</html>