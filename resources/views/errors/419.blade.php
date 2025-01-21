@extends('errors.layouts')
@section('title','Invalid Request')

@section('content')
<div class="card-body px-5 text-center">
    <div class="error-num d-inline-block">
        419
    </div>
    <h4>OOPS... <br> Invalid Request</h4>
    <p class="mb-4">Your Request contains an invalid syntax. Please try again.</p><a class="btn btn-creative btn-danger" href="{{route('index')}}">Go to Home</a>
</div>
@endsection