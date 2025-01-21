@extends('user.layouts.master')
@section('title', 'Bills Payment')

@section('content')
<div class="row g-3">
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
<span class="pb-5"></span>
@endsection