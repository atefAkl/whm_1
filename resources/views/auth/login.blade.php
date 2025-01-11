@extends('layouts.guest')

@section('content')
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('build/assets/images/logo.png') }}" alt="Logo" class="d-inline-block align-text-top" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                </ul>

                <div class="d-flex ml-auto">


                    <div class="d-flex">
                        <a class="btn btn-outline-secondary me-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                        <a class="btn btn-outline-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </nav>
</header>
<div class="container">
    <section class="bg-light shadowed mt-4">
        <div class="row">
            <div class="col p-3" style="background-image: linear-gradient(to left, #f6d365 0%, #fda085 100%);">

                <h1 class="text-center h1">Welcome back</h1>
                <p>Please log in to your account.</p>
            </div>
            <div class="col p-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1 class="text-center h3">Log in </h1>
                    <input type="hidden" name="guard_name" value="admin">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div>
@endsection