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
            background-color: #a8c5e0;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color:#fff;
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
        .invoice table, th, tr,td{
            border: #60a9ea 1px solid

        }
</style>

<body>
    <!-- nav bar -->
     <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('public/images/logo.png') }}" alt="logo" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create') }}">Creer Bulletin de salaire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list') }}">Liste Bulletins de salaire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create-invoice') }}">Creer Facture</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employees') }}">Liste des employees</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end nav bar -->
    @yield('content')

    {{-- link js code code.js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

     <script>
         document.addEventListener('DOMContentLoaded', function () {
        const navLinks = document.querySelectorAll('.nav-link');
        const currentUrl = window.location.href;

        navLinks.forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    });
        // Fetch employee data from the API
        var url = "https://api.bellehouseniger.com/api/employees/";
        var invoice_url = "https://api.bellehouseniger.com/api/invoices/"
        // var client_url = "https://api.bellehouseniger.com/api/clients/"


        async function fetchEmployeeData() {
            const matricule = document.getElementById("matricule").value;
            if (matricule.length === 0) {
                return;
            }
            const url = `https://api.bellehouseniger.com/api/employees/${matricule}`;

            try {
                const response = await fetch(url);
                // console.log(response);
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                const data = await response.json();
                console.log(data);
               
                const fields = {
                    salaire_de_base: data.base_salary,
                    heures_supplementaires: data.heures_supplementaires,
                    prime_de_salissure: data.prime_de_salissure,
                    prime_annuelle: data.prime_annuelle,
                    avance_sur_salaire: data.avance_sur_salaire,
                    assurance_maladie: data.assurance_maladie,
                    assurance_accident_de_travail: data.assurance_accident_de_travail,
                    nationalite: data.employee_nationality,
                    nom_employee: `${data.first_name || ''} ${data.last_name || ''}`,
                    add_employee: data.employee_address,
                    periode_de_paie: data.periode_de_paie,
                    date_de_paie: data.date_de_paie,
                    date_de_debut: data.date_de_debut,
                    date_de_fin: data.date_de_fin,
                    emploi: data.job_title,
                    anciennete: data.hire_date,
                    taxe: data.taxe,
                    employee_phone: data.phone_number,
                };

                for (const [id, value] of Object.entries(fields)) {
                    console.log("LET SEE");
                    
                    const element = document.getElementById(id);
                    if (element) {
                        element.value = value || "";
                    } else {
                        console.warn(`Element with id "${id}" not found.`);
                    }
                }
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

        //Fetch list of employees from the API https://api.bellehouseniger.com/api/employees and display them in the list of employees in the home page
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
        // fetchEmployees();
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
        //Fetch invoices
        async function fetchInvoices() {
            try {
                const response = await fetch(invoice_url);
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                const invoices = await response.json();
                // update rows
                updateInvoiceTable(invoices)
                
            } catch (error) {
                console.error("Error fetching employee data:", error);
            }
        }
    function updateInvoiceTable(invoices) {
        
        const invoiceList = document.querySelector('.invoice-list');
        invoiceList.innerHTML = ''; // Clear existing rows

        invoices.forEach(invoice => {
        const row = document.createElement('tr');

        const clientCell = document.createElement('td');
        clientCell.textContent = invoice.client.client_name;
        row.appendChild(clientCell);

        const dateCell = document.createElement('td');
        dateCell.textContent = invoice.date;
        row.appendChild(dateCell);

        const nameCell = document.createElement('td');
        nameCell.textContent = invoice.name;
        row.appendChild(nameCell);

        //buttons
        const buttonCell = document.createElement('td');
        const button = document.createElement('a');
        button.href = `https://api.bellehouseniger.com/api/invoices/${invoice.id}/download_pdf/`;
        button.className = "btn btn-primary btn-sm";
        button.textContent = "Telecharger";
        buttonCell.appendChild(button);
        row.appendChild(buttonCell);

        const buttonView = document.createElement('td');
        const butt = document.createElement('a');
        butt.href = `/invoices/${invoice.id}`;
        butt.className = "btn btn-primary btn-sm";
        butt.textContent = "Afficher";
        buttonView.appendChild(butt);
        row.appendChild(buttonView);
        invoiceList.appendChild(row);


         // Delete button
        const buttonDelete = document.createElement('td');
        const deleteButton = document.createElement('button');
        deleteButton.className = "btn btn-danger btn-sm";
        deleteButton.textContent = "Supprimer";
        deleteButton.addEventListener('click', async () => {
            if (confirm('Voulez-vous vraiment supprimer cette facture?')) {
                try {
                    const response = await fetch(`https://api.bellehouseniger.com/api/invoices/${invoice.id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });

                    if (response.ok) {
                        alert('Facture supprimée avec succès');
                        //fetch the invoices again
                        fetchInvoices()
                    } else {
                        alert("On n'a pas pu supprimer la facture");
                    }
                } catch (error) {
                    console.error('Error deleting invoice:', error);
                    alert('Une erreur est arrivée lors de la suppression');
                }
            }
        });
        buttonDelete.appendChild(deleteButton);
        row.appendChild(buttonDelete);

        invoiceList.appendChild(row);
        

        });
    }

    fetchInvoices()
    fetchLast3Employees();
    </script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>