@extends('user.layouts.master')
@section('title', 'Settings')

@section('content')
<div class="card mb-3 shadow-sm">
    <div class="card-body direction-rtl">
      <p class="fw-bold">Settings</p>
      <div class="single-setting-panel ">
        <div class="d-flex justify-content-between">
          <label class="switch-label">Email Notifications</label>
          <label class="jdv-switch jdv-switch mb-0">
            <input type="checkbox" @if(Auth::user()->email_notify==1)checked @endif>
            <span class="slider round"></span>
          </label>
        </div>
      </div>
      <hr class="mt-0 mb-1">
      <div class="single-setting-panel ">
        <div class="d-flex justify-content-between">
          <label class="switch-label">Dark Mode</label>
          <label class="jdv-switch jdv-switch-success mb-0">
            <input type="checkbox" id="darkModeSwitch">
            <span class="slider round"></span>
          </label>
        </div>
      </div>
    </div>
</div>
<!-- Setting Card-->
<div class="card mb-3 shadow-sm">
    <div class="card-body direction-rtl">
        <p class="fw-bold">Account</p>
        <div class="single-setting-panel"><a href="{{route('user.profile')}}">
            <div class="icon-wrapper"><i class="bi bi-person"></i></div>Update Profile</a>
        </div>
        {{-- <div class="single-setting-panel">
            <a href="#" data-bs-toggle="modal" data-bs-target="#changePinModal" aria-controls="changePinModal">
                <div class="icon-wrapper bg-info"><i class="bi bi-lock"></i></div>Change PIN
            </a>
        </div>                     --}}
    </div>
</div>
<div class="card mb-3 shadow-sm">
    <div class="card-body direction-rtl">
        <p class="fw-bold">Pages</p>
        <div class="single-setting-panel"><a href="{{route('policy')}}">
            <div class="icon-wrapper"><i class="bi bi-shield-lock"></i></div>Policy</a>
        </div>
        <div class="single-setting-panel"><a href="{{route('contact')}}">
            <div class="icon-wrapper bg-warning"><i class="fa fa-phone"></i></div>Contact Us</a>
        </div>
        <div class="single-setting-panel"><a href="{{route('logout')}}">
            <div class="icon-wrapper bg-info"><i class="bi bi-box-arrow-right"></i></div>Logout</a>
        </div>                    
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="changePinModal" tabindex="-1" aria-labelledby="changePinModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-end">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="fullscreenModalLabel">Transaction PIN</h6>
          <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('user.change_pin')}}" method="post">
                @csrf
                <div class="form-group mb-2">
                    <label for="" class="form-label">Old PIN</label>
                    <input class="form-control" type="number" name="old_pin" placeholder="your old PIN" required >
                </div>
                <div class="form-group mb-2">
                    <label for="" class="form-label">New PIN</label>
                    <input class="form-control" type="number" name="new_pin" placeholder="your new PIN" required >
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success w-100">Change PIN</button>
                </div>
            </form>
          </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
</div>

@endsection