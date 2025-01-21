@extends('errors.layouts')
@section('title','Server Error')

@section('content')
<div class="card-body px-5 text-center">
    <div class="error-num d-inline-block">
        500
    </div>
    <h4>OOPS... <br> Server Error</h4>
    <p class="mb-4">We are sorry but your request contains bad syntax and cannot be fulfilled&hellip;</p><a class="btn btn-creative btn-danger" href="{{route('index')}}">Go to Home</a>
</div>
@endsection