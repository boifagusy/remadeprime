@extends('user.layouts.master')
@section('title', 'TV Subscription')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
        <h5 class="fw-bold ">TV Subscriptions</h5>
        <a href="{{route('user.cable.logs')}}" class="btn btn-primary btn-sm">History</a>
        </div>
    </div>
  <div class="card-body">
        @foreach ($decoders as $item)
        <a class="affan-page-item" href="{{route('bills.cable.plan', strtolower($item->name) )}}">
            <img src="{{my_asset($item->image)}}" class="ser-img" alt="">{{$item->name}} Packages<i class="bi bi-chevron-right"></i>
        </a>
        @endforeach        
    </div>
</div>
@endsection

@section('scripts')

@endsection