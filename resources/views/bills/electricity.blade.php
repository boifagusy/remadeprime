@extends('user.layouts.master')
@section('title', 'Electricity Bill')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
        <h5 class="fw-bold ">Electricity Bills</h5>
        <a href="{{route('user.power.logs')}}" class="btn btn-primary btn-sm">History</a>
        </div>
    </div>
  <div class="card-body">
      <form action="{{route('bills.buypower')}}" method="post">
        @csrf
          <div class="form-group">
              <label for="" class="form-label">Select Disco<span class="text-danger">*</span></label>
              <select name="disco" id="" class="form-select" required>
                  <option > Select Disco Company</option>
                  @foreach ($powers as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group">
            <label for="" class="form-label">Meter Type<span class="text-danger">*</span></label>
            <select name="meter" id="" class="form-select" required>
                <option > Select Meter Type</option>
                <option value="1">Prepaid</option>
                <option value="2">Postpaid</option>
            </select>
        </div>
          <div class="form-group">
              <label for="" class="form-label">Meter Number <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="number" required placeholder="Meter Number">
          </div>
          <div class="form-group">
              <label for="" class="form-label">Amount <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="amount" required placeholder="Purchase Amount">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-s">Confirm Purchase</button>
          </div>
      </form>
  </div>
</div>
@endsection