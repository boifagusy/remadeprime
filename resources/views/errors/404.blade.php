@extends('errors.layouts')
@section('title','Page Not Found')

@section('content')
<div class="card-body px-5 text-center">
    <div class="error-num d-inline-block">
        404
    </div>
    <h4>OOPS... <br> Page not found!</h4>
    <p class="mb-4">We couldn't find any results for your search. Try again.</p><a class="btn btn-creative btn-danger" href="{{route('index')}}">Go to Home</a>
</div>
@endsection