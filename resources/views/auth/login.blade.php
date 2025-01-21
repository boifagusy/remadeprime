@extends('layouts.blank')
@section('title', 'Login')
@section('content')
<div class="pt-4"></div>
<div class="card">
    <div class="card-body">
    <!-- Register Form -->
    <div class="register-form mt-4">
        <h6 class="mb-3 text-center">Log in to continue to {{get_setting('title')}}</h6>
        <form method="POST" action="{{ route('user.login') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Email or Username</label>
                <input class="form-control" type="text" required name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="position-relative">
                    <input class="form-control" id="psw-input" required name="password" type="password" placeholder="Enter Password">
                    <div class="position-absolute" id="password-visibility"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
                </div>
            </div>
            {{-- <div class="form-group"> --}}
            <div class="form-check mb-2">
                <input class="form-check-input form-check-input-lg form-check-success" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Remember Me </label>
            </div>
            <button class="btn btn-primary w-100" type="submit">Sign In</button>
        </form>
    </div>
    <!-- Login Meta -->
    <div class="login-meta-data text-center">
        <a class="stretched-link forgot-password d-block mt-3 mb-1" href="{{route('password.request')}}">Forgot Password?</a>
        <p class="mb-0">New User? <a class="stretched-link" href="{{route('register')}}">Register Now</a></p>
    </div>
    </div>
</div>

@endsection
