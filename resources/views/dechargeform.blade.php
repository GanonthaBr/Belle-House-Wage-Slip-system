<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('public/style.css')}}"/>
    <!-- Favicon -->
    <link href="{{asset('public/images/logo.png')}}" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Formulaire de Decharge</h1>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-start p-md-4">
        <a class="btn btn-primary me-md-2" href="{{route('home')}}" type="button">
            < Retour </a>
    </div>
    <div class="container">
        <form action="{{route('dechargestore')}}" method="post">
            @csrf
     
                <div class="mb-3">
                    <label for="client_name" class="form-label">Nom du client: </label>
                    <input type="text" class="form-control" name="client_name" id="client_name" >
                </div>
                <div class="mb-3">
                    {{-- <label for="name" class="form-label">Name:</label> --}}
                    <input type="text" class="form-control" name="name" id="name" hidden>
                </div>
                <div class="mb-3">
                    <label for="amout_received" class="form-label">Montant:</label>
                    <input type="number" class="form-control" name="amout_received" id="amout_received">
                </div>
                <div class="mb-3">
                    <label for="motif" class="form-label">Objet:</label>
                    <input type="text" class="form-control" name="motif" id="motif">
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>