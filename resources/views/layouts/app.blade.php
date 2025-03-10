<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/css/app.css') }}">
    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }

        .toast {
            background-color: white;
            min-width: 250px;
        }

        .toast.success {
            border-left: 4px solid #28a745;
        }

        .toast.error {
            border-left: 4px solid #dc3545;
        }

        .toast-header {
            background-color: transparent;
        }
    </style>
</head>

<body style="min-height: 100vh;">
    <!-- Toast Container -->
    <div class="toast-container">
        @if(session()->any())
        <div class="toast success" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header">
                <i class="fas fa-check-circle text-success mr-2"></i>
                <strong class="mr-auto">Success</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                {{ session()->message() }}
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="toast error" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header">
                <i class="fas fa-exclamation-circle text-danger mr-2"></i>
                <strong class="mr-auto">Error</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
        @endif
    </div>

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
                    @if(Auth::check())
                    <div class="dropdown-container">
                        <button id="dropdownToggle" class="btn">{{ Auth::user()->name }}</button>
                        <ul class="dropdownMenu dropdown-menu" style="display: none;">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                            <li><a href="#">Contracts</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <div class="d-flex">
                        <a class="btn btn-outline-secondary me-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                        <a class="btn btn-outline-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

            // Initialize all toasts
            $('.toast').toast('show');

            // Auto hide toasts after 5 seconds
            setTimeout(function() {
                $('.toast').toast('hide');
            }, 5000);

            // Handle manual close
            $('.toast .close').on('click', function() {
                $(this).closest('.toast').toast('hide');
            });

            $('#dropdownToggle').click(function(event) {
                event.stopPropagation(); // Prevent the click from bubbling up to the document
                $(this).next('.dropdownMenu').slideToggle(300); // Toggle the dropdown menu
            });

            // Close the dropdown if the user clicks outside of it
            $(document).click(function() {
                $('.dropdownMenu').hide();
            });
        });
    </script>
</body>

</html>