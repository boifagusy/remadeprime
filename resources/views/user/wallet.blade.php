@extends('user.layouts.master')
@section('title', 'Wallet')

@section('content')
<div class="panel">
    <div class="panel-balance">
        <div class="left">
            <span class="title">Total Balance</span>
            <h1 class="total">{{format_price(Auth::user()->balance)}}</h1>
        </div>
        <div class="right">
        </div>
    </div>
    <hr class="my-0">
    <div class="panel-balance">
        <div class="left">
            <span class="title">Referral Balance</span>
            <h1 class="total">{{format_price(Auth::user()->bonus)}}</h1>
        </div>
    </div>
    <!-- * Wallet Footer -->
</div>
<div class="card mb-3">
  <div class="card-body"> 
    <h4 class="fw-bold my-0">Fund Account</h4> <hr class="mt-0">
    <form action="{{route('user.wallet.fund')}}" method="post">
      @csrf
      <div class="form-group">
        <label class="form-label fw-bold">Amount</label>
        <input type="number" class="form-control" name="amount" step="0.1" required placeholder="Amount">
      </div>
      {{-- payment gateway --}}
      <div class="form-group">
        <label class="form-label fw-bold">Payment Method</label>
        <div class="list-group">
          @if(sys_setting('auto_bank') == 1)
          <a class="list-group-item" href="#auto-bank">
            <input class="form-check-input me-2" type="radio" >Automatic Transfer
          </a>
          @endif
          @if(sys_setting('bank_transfer') == 1)
          <label class="list-group-item">
            <input class="form-check-input me-2" type="radio" name="gateway" value="bank">Bank Transfer
          </label>
          @endif
          @if(sys_setting('paystack_payment') == 1)
          <label class="list-group-item">
            <input class="form-check-input me-2" type="radio" name="gateway" value="paystack" checked>Paystack
          </label>
          @endif
          @if(sys_setting('flutter_payment') == 1)
          <label class="list-group-item">
            <input class="form-check-input me-2" type="radio" name="gateway" value="flutter">Flutterwave
          </label>
          @endif
          @if(sys_setting('monnify_payment') == 1)
          <label class="list-group-item">
            <input class="form-check-input me-2" type="radio" name="gateway" value="monnify">Monnify
          </label>
          @endif
          @if(sys_setting('strowallet_payment') == 1)
          <label class="list-group-item">
            <input class="form-check-input me-2" type="radio" name="gateway" value="strowallet">Strowallet
          </label>
          @endif
        </div>
      </div>
      <div class="form-group mb-0">
        <button class="btn btn-primary btn-s" type="submit">Fund Wallet</button>
      </div>
    </form>
  </div>
</div>
@if(sys_setting('auto_bank') == 1)
<div class="card" id="auto-bank">
    <div class="card-body">
        <h4 class="fw-bold mb-0">Bank Accounts</h4>
        <p>Make transfer to any of these accounts to fund your wallet instantly ({{format_price(sys_setting('auto_fee'))}} charges applied).</p>
        <div class="row">
          @if($banks !== null)
            <div class="col-md-6">
                <div class="acc-panel">
                    <h6>Bank Name: {{$banks->bankName}}</h6>
                    <h6>Acc Name: {{$banks->accountName}}</h6>
                    <p class="acc-num">Acc Number: <span onclick="copyDivContent('{{$banks->accountNumber}}')">{{$banks->accountNumber}} <i class="ms-2 far fa-copy"></i></span> </p>
                </div>
            </div>          
          @endif
        </div>
    </div>
</div>
@endif
<div class="card mt-3">
  <div class="card-body table-responsive">
    <h4 class="fw-bold">Wallet Deposit History</h4>
    <table class="w-100 table" id="dataTable2">
      <thead>
        <tr>
          <th>#</th>
          <th>Amount</th>
          <th>Method</th>
          <th>Trx Code</th>
          <th>Date</th>
          <th>Details</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($deposits as $key=> $item)
          <tr>
            <td>{{$key +1 }}</td>
            <td>{{format_price($item->amount) }}</td>
            <td>{{$item->gateway }}</td>
            <td>{{$item->trx}}</td>
            <td>{{show_datetime($item->created_at)}}</td>
            <td>{{$item->message}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection