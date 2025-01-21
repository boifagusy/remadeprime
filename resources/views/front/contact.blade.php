@extends('front.layouts.master')
@section('title', 'Contact Us')
@section('content')
<div class="card mb-3">
    <div class="card-body">
    <h5 class="mb-3 fw-bold">Write to us</h5>
    <div class="contact-form">
      <form action="{{route('contact')}}" method="post">
        @csrf
        <div class="form-group mb-3">
          <input class="form-control" type="text" name="name" placeholder="Your name" value="{{Auth::user()->name ?? ''}}" required>
        </div>
        <div class="form-group mb-3">
          <input class="form-control" type="email" name="email" placeholder="Enter email address" value="{{Auth::user()->email ?? ''}}" required>
        </div>
        <div class="form-group mb-3">
          <input class="form-control" type="text" name="phone" placeholder="Enter Phone number" value="{{Auth::user()->phone ?? ''}}">
        </div>
        <div class="form-group mb-3">
          <textarea class="form-control" name="message" cols="30" rows="10" required placeholder="Write details"></textarea>
        </div>
        <button class="btn btn-primary w-100">Send Now</button>
      </form>
    </div>
    </div>
</div>
<div class="card">
  <div class="card-body text-center">
    <h5 class="fw-bold">Social Profiles</h5>
    <div class="row mx-auto">
      <div class="direction-rtl">
        <a class="btn m-1 btn-creative btn-primary" href="{{get_setting('facebook')}}"><i class="bi bi-facebook"></i></a>
        <a class="btn m-1 btn-creative btn-success" href="{{get_setting('whatsapp')}}"><i class="bi bi-whatsapp"></i></a>
        <a class="btn m-1 btn-creative btn-danger" href="{{get_setting('instagram')}}"><i class="bi bi-instagram"></i></a>
        <a class="btn m-1 btn-creative btn-info" href="{{get_setting('twitter')}}"><i class="bi bi-twitter"></i></a>
        <a class="btn m-1 btn-creative btn-primary" href="{{get_setting('telegram')}}"><i class="bi bi-telegram"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection