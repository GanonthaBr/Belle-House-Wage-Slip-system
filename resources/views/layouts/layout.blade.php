<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- favicon --}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bulletin de Salaire</title>
</head>
<style>
    .half-screen {
        height: 50vh;
    }

    /* style for burger menu */
    .navbar-custom {
            background-color: #ffffffa7;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color:#60a9ea;
        }
        .navbar-custom .nav-link:hover {
            color: #73bfeb;
        }
        .navbar-custom .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.1);
        }
        .navbar-custom .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255, 255, 255, 0.5%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
</style>

<body>
    <!-- nav bar -->
     <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="logo" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create') }}">Creer Bulletin de salaire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list') }}">Liste Bulletins de salaire</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end nav bar -->
    @yield('content')

    {{-- link js code code.js --}}
    <script>
        // Fetch employee data from the API
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
                // console.log(data);
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
                document.getElementById("employee_phone").value = data.phone_number || "";
            } catch (error) {
                document.getElementById('wageslip-form').reset();
                //reset the form except the matricule field
                document.getElementById("matricule").value = matricule;
                // console.error("Error fetching employee data:", error);
            }
        }
        //nav bar burger menu
        var nav = document.querySelector('nav');
        var navToggle = document.querySelector('.navbar-toggler');
        navToggle.addEventListener('click', function() {
            if (nav.classList.contains('navbar-expand-lg')) {
                nav.classList.remove('navbar-expand-lg');
            } else {
                nav.classList.add('navbar-expand-lg');
            }
        });

        //Fetch list of employees from the API https://bellehouse.pythonanywhere.com/api/employees and display them in the list of employees in the home page
        async function fetchEmployees() {
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                const data = await response.json();
                // console.log(data);
                const employees = document.querySelector(".employees");
                employees.innerHTML = "";
                data.forEach((employee) => {
                    const li = document.createElement("li");
                    li.className = "list-group-item d-flex justify-content-between align-items center";
                    li.textContent = employee.first_name + " " + employee.last_name;
                    const a = document.createElement("a");
                    // a.href = "#";
                    // a.className = "btn btn-primary btn-sm";
                    // a.textContent = "Voir";
                    // li.appendChild(a);
                    employees.appendChild(li);
                });
            } catch (error) {
                console.error("Error fetching employee data:", error);
            }
        }
        fetchEmployees();
        //employees-last-3
        async function fetchLast3Employees() {
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                const data = await response.json();
                // console.log(data);
                const employees = document.querySelector(".employees-last-3");
                employees.innerHTML = "";
                data.slice(-4).forEach((employee) => {
                    const li = document.createElement("li");
                    li.className = "list-group-item d-flex justify-content-between align-items center";
                    li.textContent = employee.first_name + " " + employee.last_name;
                    const a = document.createElement("a");
                    // a.href = "#";
                    // a.className = "btn btn-primary btn-sm";
                    // a.textContent = "Voir";
                    // li.appendChild(a);
                    employees.appendChild(li);
                });
            } catch (error) {
                console.error("Error fetching employee data:", error);
            }
        }
        fetchLast3Employees();
    </script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>