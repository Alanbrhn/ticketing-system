@extends('layout.guest')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">{{ __('Confirm Password') }}</h3>
                    <p class="text-muted text-center mb-4">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                            
                            @if ($errors->has('password'))
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Confirm') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
