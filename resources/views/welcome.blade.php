<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/build/assets/css/app.css')}}" id="language-stylesheet">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <img src="{{ asset('build/assets/images/logo.png') }}" alt="Logo" class="d-inline-block align-text-top" style="height: 40px;">
                </a>
                <a class="nav-link" href="{{ route('dashboard') }}">{{ __('AG-STORES') }}</a>

                <button class="navbar-toggler" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav" style="display: none;">
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0 align-items-center">

                        <li class="nav-item active">
                            <a class="nav-link h5 fw-bold" href="">{{ __('About Us') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h5 fw-bold" href="">{{ __('Services') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h5 fw-bold" href="">{{ __('Contact') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link h5 fw-bold" href="">{{ __('Order') }}</a>
                        </li>
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link h5 fw-bold dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('build/assets/images/default.user.avatar.png') }}" alt="User Avatar" class="rounded-circle me-2" width="32" height="32">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user me-2"></i> {{ __('Profile') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">
                                        <i class="fas fa-shopping-cart me-2"></i> {{ __('Orders') }}
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link h5 fw-bold" href="{{ route('admin-login') }}">{{ __('Login') }}</a>
                        </li>
                        @endauth

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container mt-5" style="min-height: 100vh;">

        <h1>{{ __('Welcome to AG-STORES') }}</h1>
    </div>

    <footer style="background-color: #f8f9fa; padding: 20px 0; text-align: center; width: 100%;">
        <a href="{{ route('admin-dashboard-home') }}">goto dashboard</a>
        <p>&copy; 2024 AG-STORES. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.navbar-toggler').click(function() {
                $('#navbarNav').slideToggle(300); // Toggle the navbar menu
            });
        })
        $(document).click(function(event) {
            // Check if the click is outside the navbar and the toggler
            if (!$(event.target).closest('.navbar-nav, .navbar-toggler').length) {
                $('#navbarNav').slideUp(300); // Hide the navbar menu
            }
        });
    </script>
</body>

</html>