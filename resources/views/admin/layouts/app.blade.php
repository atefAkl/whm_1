<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/css/app.css') }}">
    <style>
        .sidebar {
            background-color: #2d3436;
            min-height: calc(100vh - 70px);
            padding: 0;
            color: white;
            position: fixed;
            width: inherit;
            max-width: inherit;
            z-index: 1040;
            top: 70px;
        }

        .sidebar .nav-link {
            color: white;
            padding: 10px 20px;
            margin: 0;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: #636e72;
        }

        .sidebar .nav-link.active {
            background-color: #1792b8;
        }

        .sidebar .submenu .nav-link.active {
            background-color: #1792b899;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .sidebar .submenu {
            display: none;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .sidebar .submenu.show {
            display: block;
        }

        .sidebar .submenu .nav-link {
            padding-left: 40px;
        }

        .sidebar .has-submenu > .nav-link:after {
            content: '\f107';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            float: right;
            transition: transform 0.3s;
        }

        .sidebar .has-submenu.open > .nav-link:after {
            transform: rotate(180deg);
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

        .breadcrumb {
            margin-bottom: 0;
            background-color: transparent;
            padding: 0;
        }

        .search-form {
            position: relative;
        }

        .search-form .form-control {
            padding-right: 40px;
            border-radius: 20px;
        }

        .search-form .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .user-dropdown .dropdown-toggle::after {
            display: none;
        }

        .user-dropdown .dropdown-menu {
            min-width: 200px;
            padding: 10px;
        }

        .user-dropdown .user-info-mini {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 10px;
        }

        .main-content {
            width: 100%;
            padding: 80px 20px;
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }

        .badge-pill {
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
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

        .btn-link {
            color: #6c757d;
            padding: 0.375rem;
            background: transparent;
            border: none;
            text-decoration: none;
        }

        .btn-link:hover,
        .btn-link:focus {
            color: #1792b8;
            text-decoration: none;
            background: transparent;
            border: none;
            box-shadow: none;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            color: #1792b8;
            text-decoration: none;
            background-color: #f8f9fa;
        }

        .dropdown-item:active {
            color: #fff;
            text-decoration: none;
            background-color: #1792b8;
        }

        .user-dropdown .dropdown-menu {
            min-width: 280px;
            padding: 0;
        }

        .user-info-mini {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem;
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
    @auth('admin')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0">
                <div class="sidebar">
                    <nav>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin-dashboard-home') }}" class="nav-link {{ request()->routeIs('admin-dashboard-home') ? 'active' : '' }}">
                                    <i class="fas fa-chart-line"></i>
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                            <li class="nav-item has-submenu">
                                <a href="#" class="nav-link {{ request()->is('admin/accounts*') ? 'active' : '' }}">
                                    <i class="fas fa-calculator"></i>
                                    {{ __('General Accounts') }}
                                </a>
                                <ul class="nav flex-column submenu {{ request()->is('admin/accounts*') ? 'show' : '' }}">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('Chart of Accounts') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('Journal Entries') }}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-submenu">
                                <a href="#" class="nav-link {{ request()->is('admin/inventory*') ? 'active' : '' }}">
                                    <i class="fas fa-warehouse"></i>
                                    {{ __('Inventory') }}
                                </a>
                                <ul class="nav flex-column submenu {{ request()->is('admin/inventory*') ? 'show' : '' }}">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('Items') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('Categories') }}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-submenu">
                                <a href="#" class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}">
                                    <i class="fas fa-users"></i>
                                    {{ __('Customers') }}
                                </a>
                                <ul class="nav flex-column submenu {{ request()->is('admin/customers*') ? 'show' : '' }}">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('List Customers') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('Customer Groups') }}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-submenu">
                                <a href="#" class="nav-link {{ request()->is('admin/purchases*') ? 'active' : '' }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    {{ __('Purchases') }}
                                </a>
                                <ul class="nav flex-column submenu {{ request()->is('admin/purchases*') ? 'show' : '' }}">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('Purchase Orders') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('Suppliers') }}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-submenu">
                                <a href="#" class="nav-link {{ request()->is('admin/sales*') ? 'active' : '' }}">
                                    <i class="fas fa-cash-register"></i>
                                    {{ __('Sales') }}
                                </a>
                                <ul class="nav flex-column submenu {{ request()->is('admin/sales*') ? 'show' : '' }}">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('Invoices') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('Quotations') }}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-submenu">
                                <a href="#" class="nav-link {{ request()->is('admin/operations*') ? 'active' : '' }}">
                                    <i class="fas fa-cogs"></i>
                                    {{ __('Operations') }}
                                </a>
                                <ul class="nav flex-column submenu {{ request()->is('admin/operations*') ? 'show' : '' }}">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('Reports') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('Maintenance') }}</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-submenu">
                                <a href="#" class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                                    <i class="fas fa-tools"></i>
                                    {{ __('Settings') }}
                                </a>
                                <ul class="nav flex-column submenu {{ request()->is('admin/settings*') ? 'show' : '' }}">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('General') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">{{ __('Company') }}</a>
                                    </li>
                                </ul>
                            </li>
                            @can('manage-roles')
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                    <i class="fas fa-user-shield"></i>
                                    {{ __('Roles') }}
                                </a>
                            </li>
                            @endcan
                            @can('manage-permissions')
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                                    <i class="fas fa-key"></i>
                                    {{ __('Permissions') }}
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-wrapper">
                <div class="main-content">
                    <!-- Top Header -->
                    @include('admin.includes.header')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @else
    @yield('content')
    @endauth

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/admin-sidebar.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize all dropdowns
            $('.dropdown-toggle').dropdown();

            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Close other dropdowns when one is opened
            $('.dropdown').on('show.bs.dropdown', function () {
                $('.dropdown.show').not(this).removeClass('show').find('.dropdown-menu').removeClass('show');
            });

            // Close dropdown when clicking outside
            $(document).on('click', function (e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown').removeClass('show').find('.dropdown-menu').removeClass('show');
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>