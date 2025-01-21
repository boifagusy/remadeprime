@extends('user.layouts.master')
@section('title', 'Buy Airtime')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
        <h5 class="fw-bold ">Buy Airtime</h5>
        <a href="{{route('user.airtime.logs')}}" class="btn btn-primary btn-sm">History</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('bills.airtime.buy')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="" class="form-label">Select Network <span class="text-danger">*</span></label>
                <select name="network" id="" class="form-select" required>
                    <option>--Select Network-- </option>
                    @foreach ($networks as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Phone Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" maxlength="11" name="phone" required placeholder="08035852702">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Amount <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="amount" required placeholder="Enter Purchase Amount">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-s">Confirm Purchase</button>
            </div>
        </form>
    </div>
</div>
@endsection