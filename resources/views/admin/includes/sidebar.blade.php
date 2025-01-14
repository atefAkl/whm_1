<nav class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('admin-dashboard-home') }}" class="nav-link {{ request()->routeIs('admin-dashboard-home') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>{{ __('Dashboard') }}</span>
            </a>
        </li>

        @can('manage-admins')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-users-cog"></i> {{ __('Admins') }}
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('admins-index') }}">{{ __('All Admins') }}</a></li>
                @can('register-admins')
                <li><a class="dropdown-item" href="{{ route('admin-register') }}">{{ __('Add New Admin') }}</a></li>
                @endcan
            </ul>
        </li>
        @endcan

        @can('manage-roles')
        <li class="nav-item">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#rolesSubmenu">
                <i class="fas fa-user-tag"></i>
                <span>{{ __('Roles Management') }}</span>
            </a>
            <div class="collapse" id="rolesSubmenu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin-roles-index') }}" class="nav-link {{ request()->routeIs('admin-roles-index') ? 'active' : '' }}">
                            <i class="fas fa-list"></i>
                            <span>{{ __('All Roles') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin-roles-create') }}" class="nav-link {{ request()->routeIs('admin-roles-create') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i>
                            <span>{{ __('Add New Role') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endcan

        @can('manage-permissions')
        <li class="nav-item">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#permissionsSubmenu">
                <i class="fas fa-key"></i>
                <span>{{ __('Permissions Management') }}</span>
            </a>
            <div class="collapse" id="permissionsSubmenu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin-permissions-index') }}" class="nav-link {{ request()->routeIs('admin-permissions-index') ? 'active' : '' }}">
                            <i class="fas fa-list"></i>
                            <span>{{ __('All Permissions') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin-permissions-create') }}" class="nav-link {{ request()->routeIs('admin-permissions-create') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i>
                            <span>{{ __('Add New Permission') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endcan

        <li class="nav-item">
            <a href="{{ route('admin-profile') }}" class="nav-link {{ request()->routeIs('admin-profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>{{ __('Profile') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <form method="POST" action="{{ route('admin-logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>{{ __('Logout') }}</span>
                </button>
            </form>
        </li>
    </ul>
</nav>
