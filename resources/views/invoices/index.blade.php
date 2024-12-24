@extends('layouts.layout')

@section('content')
    @foreach ($invoices as $item)
        <p>
            $item
        </p>
    @endforeach
@endsection