@extends('layouts.blank')
@section('title', "Reset Password")
@section('content')
<div class="pt-4"></div>
<div class="card">
    <div class="card-body">
    <!-- Register Form -->
    <div class="register-form mt-4">
        <h6 class="mb-3 text-center">Reset Password</h6>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input class="form-control" type="email" required name="email" value="{{ $email ?? old('email') }}" placeholder="Email Address">
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="position-relative">
                    <input class="form-control" id="psw-input" required name="password" type="password" placeholder="Enter Password">
                    <div class="position-absolute" id="password-visibility"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <div class="position-relative">
                    <input class="form-control" id="psw-input1" required name="password_confirmation" type="password" placeholder="Enter Password">
                    <div class="position-absolute" id="password-visibility1"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
                </div>
            </div>
            <button class="btn btn-primary w-100" type="submit">Reset Password</button>
        </form>
    </div>
    </div>
</div>
@endsection
