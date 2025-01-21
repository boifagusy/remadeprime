@extends('layouts.blank')
@section('title', 'Register')
@section('content')
<div class="pt-4"></div>
<div class="card">
    <div class="card-body">
        <!-- Register Form -->
        <div class="register-form mt-2">
            <h6 class="mb-3 text-center">Register to Continue on {{get_setting('title')}}.</h6>
            <form action="{{route('user.register')}}" method="post">
                @csrf
                <div class="form-group text-start mb-3">
                    <label class="form-label">Full Name</label>
                    <input class="form-control" value="{{ old('name') }}" type="text" required name="name" placeholder="Full Name">
                </div>
                <div class="form-group text-start mb-3">
                    <label class="form-label">Email Address</label>
                    <input class="form-control" value="{{ old('email') }}" type="email" name="email" required placeholder="Email address">
                </div>
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input class="form-control" type="text" value="{{ old('username') }}" required name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input class="form-control" type="tel" value="{{ old('phone') }}" required name="phone" placeholder="Phone Numer">
                </div>
                <div class="form-group">                                
                    <label class="form-label">Password</label>
                    <div class="position-relative">
                        <input class="form-control" id="psw-input" required name="password" type="password" placeholder="Enter Password">
                        <div class="position-absolute" id="password-visibility"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
                    </div>
                </div>                           
                <div class="form-group">
                    <label class="form-label">Referral</label>
                    <input class="form-control" type="text" name="referral" value="{{$refer ?? ''}}" placeholder="Referral Code (optioal)">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input form-check-input-lg form-check-success" required type="checkbox" name="policy" id="policy" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">I agree with the terms &amp; policy.</label>
                </div>
                <button class="btn btn-primary w-100" type="submit">Sign Up</button>
            </form>
        </div>
        <!-- Login Meta -->
        <div class="login-meta-data text-center">
            <p class="mt-3 mb-0">Already have an account? <a class="stretched-link" href="{{route("login")}}">Login</a></p>
          </div>
    </div>
</div>

@endsection
