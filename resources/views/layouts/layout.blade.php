<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bulletin de Salaire</title>
</head>
<style>
    .half-screen{
        height: 50vh;
    }
    .card{
        /* background: #cfcbcb57 */
    }
</style>
<body>
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
        document.getElementById("nom_employee").value = data.first_name +' '+ data.last_name || "";
        document.getElementById("add_employee").value = data.add_employee || "";
        document.getElementById("periode_de_paie").value =
            data.periode_de_paie  || "";
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