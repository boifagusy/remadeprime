@extends('layouts.blank')
@section('title', "Reset Password")
@section('content')
<div class="pt-4"></div>
<div class="card">
    <div class="card-body">
    <!-- Register Form -->
    <div class="register-form mt-4">
        <h6 class="mb-3 text-center">Reset Password</h6>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input class="form-control" type="email" required name="email" value="{{ old('email') }}" placeholder="Email Address">
            </div>
            <button class="btn btn-primary w-100" type="submit">Send Reset Link</button>
        </form>
    </div>
    </div>
</div>

@endsection
