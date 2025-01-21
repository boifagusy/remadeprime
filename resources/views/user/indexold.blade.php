@extends('user.layouts.master2')
@section('title', 'Dashoard')

@section('content')
<div class="panel">
  <div class="panel-balance">
      <div class="left">
          <span class="title">Total Balance</span>
          <h1 class="total">{{format_price(Auth::user()->balance)}}</h1>
      </div>
      <div class="right">
        <a href="{{route('user.wallet')}}" class="btn btn-secondary">
          <i class="fa fa-plus fa-2x"></i>
        </a>
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
    <h5 class="fw-bold">Referral Link</h5>
    <p>You earn {{sys_setting('referral_commission')}}% on every transactions your referral makes</p>
    <div class="input-group mb-3">
      <span class="input-group-text"><i class="fa fa-link"></i></span>
      <input class="form-control" type="text" placeholder="{{route('register').'/?ref='.Auth::user()->username}}" value="{{route('register').'/?ref='.Auth::user()->username}}">
      <button class="input-group-text" onclick="copyDivContent('{{route('register').'/?ref='.Auth::user()->username}}')">Copy Link </button>
    </div>
  </div>
</div>
{{-- Bills --}}
<div class="row g-3">
  <h5 class="card-title fw-bold">Bills Payment</h5>
  @if (sys_setting('is_airtime') == 1)
    <div class="col-6 col-sm-4 col-lg-3">
      <div class="card single-product-card">
        <div class="card-body p-3 text-center">
            <a class="product-thumbnail d-block" href="{{route('bills.airtime')}}"><img src="{{my_asset('services/airtime.jpg')}}" class="bill-img" alt=""></a>
            <p class="product-title d-block text-truncate">Airtime</p>
            <a class="btn btn-outline-info btn-sm" href="{{route('bills.airtime')}}">
                <i class="bi bi-cart me-2"></i>Purchase
            </a>
        </div>
      </div>
    </div>
  @endif
  @if (sys_setting('is_data') == 1)
    <div class="col-6 col-sm-4 col-lg-3">
      <div class="card single-product-card">
        <div class="card-body p-3 text-center">
            <a class="product-thumbnail d-block" href="{{route('bills.data')}}"><img src="{{my_asset('services/data.jpg')}}" class="bill-img" alt=""></a>
            <p class="product-title d-block text-truncate">Data</p>
            <a class="btn btn-outline-info btn-sm" href="{{route('bills.data')}}">
                <i class="bi bi-cart me-2"></i>Purchase
            </a>
        </div>
      </div>
    </div>
  @endif
  @if (sys_setting('is_cable') == 1)
    <div class="col-6 col-sm-4 col-lg-3">
      <div class="card single-product-card">
        <div class="card-body p-3 text-center">
            <a class="product-thumbnail d-block" href="{{route('bills.cable')}}"><img src="{{my_asset('services/cabletv.jpg')}}" class="bill-img" alt=""></a>
            <p class="product-title d-block text-truncate">Cable TV</p>
            <a class="btn btn-outline-info btn-sm" href="{{route('bills.cable')}}">
                <i class="bi bi-cart me-2"></i>Purchase
            </a>
        </div>
      </div>
    </div>
  @endif
  @if (sys_setting('is_education') == 1)
    <div class="col-6 col-sm-4 col-lg-3">
      <div class="card single-product-card">
        <div class="card-body p-3 text-center">
            <a class="product-thumbnail d-block" href="{{route('bills.education')}}"><img src="{{my_asset('services/education.jpg')}}" class="bill-img" alt=""></a>
            <p class="product-title d-block text-truncate">Result PIN</p>
            <a class="btn btn-outline-info btn-sm" href="{{route('bills.education')}}">
                <i class="bi bi-cart me-2"></i>Purchase
            </a>
        </div>
      </div>
    </div>
  @endif
  @if (sys_setting('is_electricity') == 1)
    <div class="col-6 col-sm-4 col-lg-3">
      <div class="card single-product-card">
        <div class="card-body p-3 text-center">
            <a class="product-thumbnail d-block" href="{{route('bills.electricity')}}"><img src="{{my_asset('services/power.jpg')}}" class="bill-img" alt=""></a>
            <p class="product-title d-block text-truncate">Electricity</p>
            <a class="btn btn-outline-info btn-sm" href="{{route('bills.electricity')}}">
                <i class="bi bi-cart me-2"></i>Purchase
            </a>
        </div>
      </div>
    </div>
  @endif
  @if (sys_setting('is_bulksms') == 1)
    <div class="col-6 col-sm-4 col-lg-3">
      <div class="card single-product-card">
        <div class="card-body p-3 text-center">
            <a class="product-thumbnail d-block" href="{{route('bills.bulksms')}}"><img src="{{my_asset('services/bulksms.jpg')}}" class="bill-img" alt=""></a>
            <p class="product-title d-block text-truncate">Bulk SMS</p>
            <a class="btn btn-outline-info btn-sm" href="{{route('bills.bulksms')}}">
                <i class="bi bi-cart me-2"></i>Send SMS
            </a>
        </div>
      </div>
    </div>
  @endif
  @if (sys_setting('airtime_pin') == 1)
    <div class="col-6 col-sm-4 col-lg-3">
      <div class="card single-product-card">
        <div class="card-body p-3 text-center">
            <a class="product-thumbnail d-block" href="{{route('bills.airtimepin')}}"><img src="{{my_asset('services/print.jpg')}}" class="bill-img" alt=""></a>
            <p class="product-title d-block text-truncate">Airtime PIN</p>
            <a class="btn btn-outline-info btn-sm" href="{{route('bills.airtimepin')}}">
                <i class="bi bi-cart me-2"></i>Purchase
            </a>
        </div>
      </div>
    </div>
  @endif
  @if (sys_setting('airtime_cash') == 1)
    <div class="col-6 col-sm-4 col-lg-3">
      <div class="card single-product-card">
        <div class="card-body p-3 text-center">
            <a class="product-thumbnail d-block" href="{{route('bills.a2c')}}"><img src="{{my_asset('services/airtimeswap.jpg')}}" class="bill-img" alt=""></a>
            <p class="product-title d-block text-truncate">Airtime 2 Cash</p>
            <a class="btn btn-outline-info btn-sm" href="{{route('bills.a2c')}}">
                <i class="bi bi-cart me-2"></i>Purchase
            </a>
        </div>
      </div>
    </div>
    @endif
</div>
<div class="py-2"></div>
<div class="card">
  <div class="card-body table-responsive">
    <div class="d-flex align-items-center justify-content-between">
      <h5 class="card-title mb-3 fw-bold">Recent Transactions</h5>
      <a href="{{route('user.transactions')}}" class="btn btn-primary btn-sm">View All</a>
    </div>
    <table class="table w-100" id="dataTable2">
      <thead>
        <tr>            
          <th>#</th>
          <th>Service</th>           
          <th>TRX Code</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Status</th>
          <th>Details</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($transactions as $key => $item)
          <tr>
            <td>{{$key + 1}}</td>
            <td><span class="badge bg-info">{{short_trx_type($item->service)}} </span> </td>
            <td>{{$item->code}}</td>
            <td>{{format_price($item->amount)}}</td>
            <td>{{$item->created_at->diffForHumans()}}</td>
            <td>
              @if($item->status == 1)
                  <span class="badge bg-success">successful</span>
              @elseif ($item->status == 2)
                  <span class="badge bg-warning">pending</span>
              @elseif ($item->status == 3)
                  <span class="badge bg-danger">cancelled</span>
              @endif    
            </td>
            <td><a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#trxDetail{{$item->id}}" >View</a></td>
          </tr>
          {{-- modal --}}
          <div class="modal fade" id="trxDetail{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header py-0">
                      <h6 class="modal-title" id="myModalLabel"> Transaction Details</h6>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                        <p> <b>Transaction ID </b> : {{$item->code}} </p>
                        <p class="col-sm-6"><b> Date :</b> {{show_datetime($item->created_at)}} </p>
                        <p class="col-sm-6"> <b>Status : </b> @if($item->status == 1)
                            <span class="badge bg-success">successful</span> @elseif ($item->status == 2) <span class="badge bg-warning">pending</span> @elseif ($item->status == 3) <span class="badge bg-danger">cancelled</span>  @endif   
                        </p>
                        <p class="col-6"> <b>Amount :</b> {{format_price($item->amount)}} </p>
                        <p class="col-6"> <b>Charge :</b> {{format_price($item->charge)}} </p>
                        <p class="col-6"> <b>New Bal:</b> {{format_price($item->new_balance)}} </p>
                        <p class="col-6"> <b>Old Bal :</b> {{format_price($item->old_balance)}} </p>
                        <p class="col-6"><b>Type :</b> {!! trans_type($item->type) !!} </p>
                        <p class="col-6"><b>Service : </b> <span class="badge bg-info">{{short_trx_type($item->service)}} </span> </p>
                        <p class="col-sm-12"><b>Details :</b> {{$item->message}} </p>
                      </div>
                  </div>
              </div>
            </div>
        </div>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection