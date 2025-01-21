@extends('layouts.blank')
@section('title', "Verify Account")
@section('content')
<div class="pt-3">
    <div class="card">
        <div class="card-header fw-bold">{{ __('Verify Your Email Address') }}</div>

        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
            <h4 class="mb-3">Welcome!</h4>
            <h6 class="p">Hi {{Auth::user()->username}}, Welcome to {{get_setting('title')}}</h6>
            
            <h6> {{ __('Before proceeding, please verify your email below') }} </h6>
            <p>{{ __('You will receive an email to verify your account. Please check your spam box') }} </p>
            <form class="mt-3" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary w-100">Verify Account</button>.
            </form>
        </div>
    </div>
</div>
@endsection
