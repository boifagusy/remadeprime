@extends('user.layouts.master')
@section('title', 'Edit Profile')

@section('content')
<div class="card user-data-card">
    <div class="card-body">
      <form action="{{route('user.profile.update')}}" method="post">
        @csrf
        <div class="form-group mb-3">
          <label class="form-label" for="fullname">Full Name</label>
          <input class="form-control" required name="name" type="text" value="{{Auth::user()->name}}" placeholder="Full Name">
        </div>
        <div class="form-group mb-3">
          <label class="form-label" for="Username">Username</label>
          <input class="form-control" required name="Username" type="text" value="{{Auth::user()->username}}" readonly placeholder="Username">
        </div>
        <div class="form-group mb-3">
          <label class="form-label" for="email">Email Address</label>
          <input class="form-control" required id="email" type="text" value="{{Auth::user()->email}}" placeholder="Email Address" readonly>
        </div>
        <div class="form-group mb-3">
          <label class="form-label" for="phone">Phone Numer</label>
          <input class="form-control" required name="phone" type="tel" value="{{Auth::user()->phone}}" placeholder="Phone Number">
        </div>
        <div class="form-group mb-3">
          <label class="form-label" for="address">Address</label>
          <input class="form-control" name="address" type="text" value="{{Auth::user()->address}}" placeholder="Address">
        </div>
        <button class="btn btn-success w-100" type="submit">Update Now</button>
      </form>
    </div>
</div>
<!-- USer Password -->
<div class="card user-data-card mt-3">
    <h5 class="card-header">Change Password</h5>
    <div class="card-body">
        <form action="{{route('user.password.update')}}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label">Old Password</label>
                <div class="position-relative">
                    <input class="form-control" id="psw-input" required name="old_password" type="password" placeholder="Enter Password">
                    <div class="position-absolute" id="password-visibility"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
                </div>
            </div>
            <div class="form-group mb-3"> 
                <label class="form-label">New Password</label>
                <div class="position-relative">
                    <input class="form-control" id="psw-input1" required name="new_password" type="password" placeholder="Enter Password">
                    <div class="position-absolute" id="password-visibility1"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
                </div>
            </div>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-success w-100">Change Password</button>
            </div>
        </form>
  </div>
</div>
@endsection