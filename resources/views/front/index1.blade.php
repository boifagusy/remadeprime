@extends('front.layouts.main')
@section('title', get_setting('title'))
@section('content')
<div class="card bg-primary mb-3 bg-img">
  <div class="card-body direction-rtl p-5">
    <h2 class="text-white">{{get_setting('title')}}</h2>
    <p class="mb-4 text-white">{{get_setting('description')}}</p>
    <a class="btn btn-warning" href="{{route('login')}}">Login</a>
    <a class="btn btn-warning" href="{{route('register')}}">Register</a>
  </div>
</div>
<h4 class="text-center fw-bold">Why Choose Us?</h4>
<div class="row mb-lg-0 mb-md-5">
    <div class="col-md-4 mb-md-2 mb-3 ">
        <div class="card pb-4">
            <div class="px-2">
                <span class="fab fa-envira mt-2 fa-icons"></span>
                <p class="h4 pt-4">Excellent Service</p>
                <p class="p1 text-muted">
                    You can view real-time report logs on all transactions i.e you can monitor sales as they happen.
                </p>
                <span class="fas fa-arrow-right"></span>
            </div>                    
        </div>
    </div>
    <div class="col-md-4 mb-md-2 mb-3">
        <div class="card pb-4 px-2">
            <span class="fas fa-cut mt-2 fa-icons"></span>
            <p class="h4 pt-4">Automated Delivery</p>
            <p class="p1 text-muted">
                We have swift automated system with a 24/7 delivery service almost instantly, nothing beats a seamless process..
            </p>
            <span class="fas fa-arrow-right"></span>
        </div>
    </div>
    <div class="col-md-4 mb-md-2 mb-3">
        <div class="card pb-4 px-2">
            <span class="fa-icons fas fa-people-carry mt-2"></span>
            <p class="h4 pt-4">Quality Support</p>
            <p class="p1 text-muted">
                We guarantee our customers top notch services all time. Hence, we are always respond to your needs.
            </p>
            <span class="fas fa-arrow-right"></span>
        </div>
    </div>
    <div class="col-md-4 mb-md-2 mb-3">
        <div class="card pb-4 px-2">
            <span class="fas fa-cut mt-2 fa-icons"></span>
            <p class="h4 pt-4">Multi Payment Gateway</p>
            <p class="p1 text-muted">
                You have a wide range of payment options manually & automatic to fund your wallet.
            </p>
            <span class="fas fa-arrow-right"></span>
        </div>
    </div>
    <div class="col-md-4 mb-md-2 mb-3">
        <div class="card pb-4 px-2">
            <span class="fa-icons fas fa-people-carry mt-2"></span>
            <p class="h4 pt-4">Quality Reports</p>
            <p class="p1 text-muted">
                View real-time report logs on all transactions. Monitor sales as it happens.
            </p>
            <span class="fas fa-arrow-right"></span>
        </div>
    </div>
    <div class="col-md-4 mb-md-2 mb-3">
        <div class="card pb-4 px-2">
            <span class="fas fa-cut mt-2 fa-icons"></span>
            <p class="h4 pt-4">Reliable Services</p>
            <p class="p1 text-muted">
                You too can have your own VTU Web Portal like this or use our API system.
            </p>
            <span class="fas fa-arrow-right"></span>
        </div>
    </div>
</div>
{{-- Bills --}}
<div class="row g-3">
  <h5 class="text-center fw-bold">All Services</h5>
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
<div class="card my-3">
    <div class="card-body">
      <h3>Customer Review</h3>
      <div class="testimonial-slide-three-wrapper">
        <div class="testimonial-slide3 testimonial-style3">
          <!-- Single Testimonial Slide -->
          <div class="single-testimonial-slide">
            <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill"></i></span>
              <h6 class="mb-2">The code looks clean, and the designs are excellent. I recommend.</h6><span class="d-block">Mrrickez, Themeforest</span>
            </div>
          </div>
          <!-- Single Testimonial Slide -->
          <div class="single-testimonial-slide">
            <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill"></i></span>
              <h6 class="mb-2">All complete, <br> great craft.</h6><span class="d-block">Mazatlumm, Themeforest</span>
            </div>
          </div>
          <!-- Single Testimonial Slide -->
          <div class="single-testimonial-slide">
            <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill"></i></span>
              <h6 class="mb-2">Awesome template! <br> Excellent support!</h6><span class="d-block">Vguntars, Themeforest</span>
            </div>
          </div>
          <!-- Single Testimonial Slide -->
          <div class="single-testimonial-slide">
            <div class="text-content"><span class="d-inline-block badge bg-warning mb-2"><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill"></i></span>
              <h6 class="mb-2">Nice modern design, <br> I love the product.</h6><span class="d-block">electroMEZ, Themeforest</span>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('styles')
<style>
    .card .fas.fa-arrow-right {
        position: absolute;
        bottom: -100px;
        background-color: #7499f1;
        height: 50px;
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: gold;
        opacity: 0;
        transform: translateY(50%);
        transition: all 0.5s ease;
    }

    .card:hover .fas.fa-arrow-right {
        bottom: 0px;
        opacity: 1;
    }

    .card .fa-icons {
        font-size: 40px;
        background-color: #0000000d;
        height: 70px;
        width: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #287341;
    }

    .card .h4 {
        font-weight: 500;
    }

</style>
@endsection