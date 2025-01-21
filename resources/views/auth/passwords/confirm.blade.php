@extends('layouts.blank')
@section('title', 'Confirm Password')
@section('content')
<div class="pt-4"></div>
<div class="card">
    <div class="card-body">
    <!-- Register Form -->
    <div class="register-form mt-4">
        <h6 class="mb-3 text-center">Confirm Password</h6>
        
       <p>{{ __('Please confirm your password before continuing.') }} </p>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            </div>
            <button class="btn btn-primary w-100" type="submit">Confirm Password</button>

            <div class="login-meta-data text-center mt-2">
            <a class="btn btn-link" href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }} </a>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection
