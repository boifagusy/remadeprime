@extends('user.layouts.master')
@section('title', 'Referrals')

@section('content')
<div class="panel">
  <div class="panel-balance">
      <div class="left">
          <h5 class="title">Total</h5>
          <h6 class="fw-bold">Referrals</h6>
      </div>
      <div class="right">
          <h6 class="total">{{Auth::user()->referrals->count()}}</h6>
      </div>
  </div>
  <hr class="my-0">
  <div class="panel-balance">
    <div class="left">
      <h5 class="title">Referral</h5>
      <h6 class="fw-bold">Earings</h6>
    </div>
    <div class="right">
        <h6 class="total">{{format_price(Auth::user()->bonus)}}</h6>
    </div>
  </div>
</div>
<div class="card mb-3">
  <div class="card-body">
    <h5 class="fw-bold">Referral Link</h5>
    <p>You earn {{sys_setting('referral_commission')}}% on every transactions your referral makes</p>
    <div class="input-group mb-3">
      <span class="input-group-text"><i class="fa fa-link"></i></span>
      <input class="form-control" type="text" placeholder="{{route('register').'/?ref='.Auth::user()->username}}" value="{{route('register').'/?ref='.Auth::user()->username}}">
      <button class="input-group-text" onclick="copyDivContent('{{route('register').'/?ref='.Auth::user()->username}}')">Copy Link </button>
    </div>
  </div>
</div>
<div class="card mb-3">
  <div class="card-body">
    <h5 class="fw-bold">Referral Bonus</h5>
    <p>Convert your referral earnings to main balance</p>
    <form action="{{route('user.referral.withdraw')}}" method="post">
      <div class="form-group">
        @csrf
        <label class="form-label">Amount</label>
        <input name="amount" type="number" class="form-control" placeholder="referral earnings to withdraw" required>
        <div class="form-group mt-2 text-end">
          <button class="btn btn-success" type="submit">Withdraw</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <h5 class="fw-bold">Top Referrals</h5>
    <table class="w-100" id="dataTable">
      <thead>
        <tr>
          <th>Name</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach (Auth::user()->referrals as $referral)
          <tr>
            <td>{{$referral->name}}</td>
            <td>{{show_datetime($referral->created_at)}}</td>
            <td><span class="badge @if($referral->suspend == 1)bg-danger @else bg-success @endif">@if($referral->suspend == 1)banned @else active @endif </span></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection