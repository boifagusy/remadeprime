@extends('user.layouts.master')
@section('title', 'Buy Data')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
        <h5 class="fw-bold ">Buy Data</h5>
        <a href="{{route('user.data.logs')}}" class="btn btn-primary btn-sm">History</a>
        </div>
    </div>
    <div class="card-body">
        @foreach ($networks as $item)
        <a class="affan-page-item" href="{{route('bills.data.plan', strtolower($item->name) )}}">
            <img src="{{my_asset($item->image)}}" class="ser-img" alt="">{{$item->name}} Data<i class="bi bi-chevron-right"></i>
        </a>
        @endforeach        
    </div>
</div>
@endsection