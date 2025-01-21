@extends('errors.layouts')
@section('title','Site Under Maintainance ')

@section('content')
<div class="card-body px-5 text-center">
    <div class="error-num d-inline-block">
        503
    </div>
    <h4>OOPS... <br> Site Under Maintainance </h4>
    <p class="mb-4">This site is under developement/Maintenance. We will be back soon</p><a class="btn btn-creative btn-danger" href="{{route('index')}}">Go to Home</a>
</div>
@endsection