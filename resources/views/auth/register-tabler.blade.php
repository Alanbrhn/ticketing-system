@extends('layout.guest')

@section('content')
<div class="page page-center">
    <div class="container container-tight py-4">
        <form class="card card-md" method="POST" action="{{ route('register') }}" autocomplete="off" novalidate>
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Create New Account</h2>

               
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        placeholder="Enter your name" 
                        value="{{ old('name') }}"
                    >
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

              
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        placeholder="Enter your email" 
                        value="{{ old('email') }}"
                    >
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

               
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group input-group-flat">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            placeholder="Enter your password" 
                            autocomplete="new-password"
                        >
                        <span class="input-group-text">
                            <a href="#" class="link-secondary toggle-password" data-bs-toggle="tooltip" title="Show password">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg>
                            </a>
                        </span>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

              
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="form-control @error('password_confirmation') is-invalid @enderror" 
                        placeholder="Confirm your password" 
                        autocomplete="new-password"
                    >
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

              
                {{-- <div class="mb-3">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="terms">
                        <span class="form-check-label">
                            I agree to the <a href="{{ route('terms') }}" tabindex="-1">terms and policy</a>.
                        </span>
                    </label>
                </div> --}}

              
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Create New Account</button>
                </div>
            </div>
        </form>

     
        <div class="text-center text-secondary mt-3">
            Already have an account? <a href="{{ route('login') }}" tabindex="-1">Sign in</a>
        </div>
    </div>
</div>
@endsection
