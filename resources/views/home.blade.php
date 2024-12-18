@extends('layouts.layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Bulletin de salaire Belle House</h1>
            <a href="{{route('wageslip.downloadPDF')}}">downloadPDF</a>
        </div>
</div>
@endsection