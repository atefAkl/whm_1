<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/css/app.css') }}">
</head>

<body style="min-height: 100vh;">
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {

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