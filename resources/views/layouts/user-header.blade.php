<div class="top-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!-- Breadcrumb -->
            <div class="col-md-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>

            <!-- Search Form -->
            <div class="col-md-4">
                <form class="search-form" action="{{ route('search') }}" method="GET">
                    <input type="text" class="form-control" placeholder="{{ __('Search...') }}" name="search">
                    <i class="fas fa-search search-icon"></i>
                </form>
            </div>

            <!-- User Info -->
            <div class="col-md-4 text-right d-flex justify-content-end align-items-center">
                <!-- Notifications -->
                <div class="dropdown mx-2">
                    <a class="btn btn-link text-dark position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell fa-lg"></i>
                        <span class="badge badge-danger badge-pill position-absolute" style="top: -5px; right: -5px;">2</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">{{ __('Notifications') }}</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item d-flex align-items-center py-2" href="#">
                            <div class="icon-circle bg-primary text-white mr-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border-radius: 50%;">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div>
                                <p class="mb-0">{{ __('Your order has been shipped') }}</p>
                                <small class="text-muted">15 minutes ago</small>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-center" href="{{ route('notifications.index') }}">{{ __('View All Notifications') }}</a>
                    </div>
                </div>

                <!-- User Profile -->
                <div class="dropdown user-dropdown">
                    <a class="btn dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('build/assets/images/default.user.avatar.png') }}" alt="User Avatar" class="rounded-circle" width="32" height="32">
                        <span class="d-none d-md-inline-block ms-2">{{ substr(Auth::user()->name, 0, 12) }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <div class="user-info-mini p-3 border-bottom">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset('build/assets/images/default.user.avatar.png') }}" alt="User Avatar" class="rounded-circle me-2" width="50">
                                <div>
                                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user me-2"></i> {{ __('Profile') }}
                        </a>
                        <a class="dropdown-item py-2" href="{{ route('orders.index') }}">
                            <i class="fas fa-shopping-cart me-2"></i> {{ __('Orders') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger py-2">
                                <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
