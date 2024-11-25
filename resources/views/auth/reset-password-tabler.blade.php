@extends('layout.guest')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">{{ __('Reset Password') }}</h3>
                    <p class="text-muted text-center mb-4">
                        {{ __('Enter your email address and new password to reset your account password.') }}
                    </p>

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" name="email" class="form-control" 
                                value="{{ old('email', $request->email) }}" 
                                required autofocus autocomplete="username">
                            @if ($errors->has('email'))
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            @endif
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" name="password" class="form-control" 
                                required autocomplete="new-password">
                            @if ($errors->has('password'))
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            @endif
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" 
                                class="form-control" required autocomplete="new-password">
                            @if ($errors->has('password_confirmation'))
                                <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
