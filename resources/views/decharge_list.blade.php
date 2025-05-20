<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Decharge</title>
        {{-- Favicon --}}
        <link href="{{asset('public/images/logo.png')}}" rel="icon" />
        <link rel="stylesheet" href="{{asset('public/stylesheet.css')}}" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Playwrite+CU:wght@100..400&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Playwrite+CL:wght@100..400&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    </head>
<body>
    
  {{-- @php
      dd($decharges->all());
  @endphp --}}

<div class="container">
    <h2>Decharges List</h2>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                       
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($decharges as $decharge)
                            <tr>
                                <td>{{ $decharge->id }}</td>
                                <td>{{$decharge->client_name}}</td>                               
                                <td>{{ $decharge->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <!-- Show button -->
                                        <a href="{{ route('dechargeshow', $decharge->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i> Show
                                        </a>
                                        
                                        <!-- Edit button -->
                                        <a href="{{ route('editdecharge', $decharge->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        
                                        <!-- Download button -->
                                        <a href="{{ route('dechargepdf', $decharge->id) }}" class="btn btn-success btn-sm">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                        
                                        <!-- Delete button -->
                                        <form action="{{ route('deletedecharge', $decharge->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No decharges found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
               
            </div>
        </div>
    </div>
</div>
</body>
</html>