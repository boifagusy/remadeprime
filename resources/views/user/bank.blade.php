@extends('user.layouts.master')
@section('title', 'Bank Accounts')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="fw-bold mb-0">Bank Accounts</h4>
        <p>Make transfer to any of these accounts to fund your wallet instantly ({{format_price(sys_setting('auto_fee'))}} charge applied).</p>
        <div class="row">
            @if ($banks !== null)
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
@endsection