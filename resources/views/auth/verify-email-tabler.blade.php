@extends('layout.guest')

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">{{ __('Verify Your Email') }}</h2>
            <p class="text-muted text-center mb-4">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success text-center">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mt-4">
                <!-- Resend Verification Email -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <!-- Log Out -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="text-center text-secondary mt-3">
        Already verified your email? <a href="{{ route('login') }}" tabindex="-1"> Login here </a>
    </div>
@endsection
