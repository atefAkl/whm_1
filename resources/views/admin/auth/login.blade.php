@extends('admin.layouts.app')
@section('title', 'Admin Login')
@section('content')
<style>
    .login-container {
        background: linear-gradient(135deg, #0056b3 0%, #007bff 100%);
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin: 2rem auto;
        max-width: 1000px;
    }

    .welcome-section {
        padding: 3rem;
        color: white;
    }

    .welcome-section h1 {
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .login-form-section {
        background: white;
        border-radius: 10px;
        padding: 2rem;
        margin: 1rem;
    }

    .form-control {
        border: 1px solid #e1e1e1;
        padding: 0.75rem;
        border-radius: 5px;
    }

    .btn-signin {
        background: #007bff;
        color: white;
        padding: 0.75rem;
        border-radius: 5px;
        border: none;
        width: 100%;
        font-weight: 500;
    }

    .btn-signin:hover {
        background: #0056b3;
    }
</style>

<div class="container  align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="login-container mt-5">
        <div class="row g-0">
            <div class="col-md-6 welcome-section">
                <h1 class="text-uppercase">Welcome Back</h1>
                <p class="h4 mb-2 text-uppercase">Provide your credentials</p>
                <p class="text-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="col-md-6">
                <div class="login-form-section">
                    <h2 class="text-center mb-4">Admin Log in</h2>
                    <form method="POST" action="{{ route('admin-check-info') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                placeholder="Email Address"
                                value="{{ old('email') }}"
                                required
                                autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="Password"
                                required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <a href="#" class="text-decoration-none">Forgot Password?</a>
                        </div>
                        @if(session('error'))
                        <div class="alert alert-danger mb-3">
                            {{ session('error') }}
                        </div>
                        @endif
                        <button type="submit" class="btn-signin mb-3">Sign in</button>
                        <div class="text-center">
                            <small>Don't have an account? <a href="{{ route('admin-register') }}" class="text-decoration-none">Sign up</a></small>
                            <small>Not an admin? <a href="{{ route('login') }}" class="text-decoration-none">Users Login</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection