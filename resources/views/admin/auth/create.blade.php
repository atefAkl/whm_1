@extends('admin.layouts.app')
@section('title', 'Admin Register')
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
                <h1 class="text-uppercase">Welcome</h1>
                <p class="h5 mb-2 text-uppercase">Add new admin to the team</p>
                <p class="text-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="col-md-6">
                <div class="login-form-section">
                    <h2 class="text-center mb-4">Sign up</h2>
                    <form method="POST" action="{{ route('admin-store') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="user_name">Name</label>
                            <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror"
                                name="user_name" value="{{ old('user_name') }}" required autofocus>
                            @error('user_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required>
                        </div>
                        <div class="input-group">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection