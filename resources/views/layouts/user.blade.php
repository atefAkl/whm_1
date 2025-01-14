<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/css/app.css') }}">
    <style>
        .user-sidebar {
            background-color: #f8f9fa;
            min-height: calc(100vh - 70px);
            padding: 0;
            position: fixed;
            width: inherit;
            max-width: inherit;
            z-index: 1040;
            top: 70px;
            border-right: 1px solid #dee2e6;
        }

        .user-sidebar .nav-link {
            color: #495057;
            padding: 10px 20px;
            margin: 0;
            transition: all 0.3s;
        }

        .user-sidebar .nav-link:hover {
            background-color: #e9ecef;
        }

        .user-sidebar .nav-link.active {
            background-color: #1792b8;
            color: white;
        }

        .user-sidebar .submenu .nav-link.active {
            background-color: #1792b899;
        }

        .user-sidebar .nav-link i {
            margin-right: 10px;
        }

        .user-sidebar .submenu {
            display: none;
            background-color: rgba(0, 0, 0, 0.03);
        }

        .user-sidebar .submenu.show {
            display: block;
        }

        .user-sidebar .submenu .nav-link {
            padding-left: 40px;
        }

        .top-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
            padding: 15px;
            height: 70px;
        }

        .main-content {
            margin-top: 70px;
            margin-left: 0;
            padding: 20px;
        }

        @media (min-width: 768px) {
            .main-content {
                margin-left: 16.666667%;
            }
        }

        .dropdown-menu {
            box-shadow: 0 2px 8px rgba(0,0,0,.1);
            border: 1px solid rgba(0,0,0,.1);
            min-width: 300px;
        }

        .dropdown-header {
            font-weight: 600;
            color: #2d3436;
            background-color: #f8f9fa;
            padding: 0.75rem 1rem;
        }

        .badge {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 50rem;
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545;
        }
    </style>
    @stack('styles')
</head>

<body>
    @auth
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0">
                <div class="user-sidebar">
                    <nav>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                    <i class="fas fa-home"></i>
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                                    <i class="fas fa-user"></i>
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('orders.index') }}" class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    {{ __('Orders') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('notifications.index') }}" class="nav-link {{ request()->routeIs('notifications.*') ? 'active' : '' }}">
                                    <i class="fas fa-bell"></i>
                                    {{ __('Notifications') }}
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-wrapper">
                <!-- Header -->
                @include('layouts.user-header')
                
                <!-- Content -->
                <div class="main-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @else
    @yield('content')
    @endauth

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl)
            });

            // Initialize all tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
