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
                <a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
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
            <li class="nav-item has-submenu">
                <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <i class="fas fa-user-shield"></i>
                    {{ __('Manage Roles') }}
                </a>
                <ul class="nav flex-column submenu {{ request()->is('admin/settings*') ? 'show' : '' }}">
                    <li class="nav-item">
                        <a href="{{ route('admin-roles-index') }}" class="nav-link">{{ __('Index') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">{{ __('Users Roles') }}</a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('manage-permissions')
            <li class="nav-item has-submenu">
                <a class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                    <i class="fas fa-key"></i>
                    {{ __('Manage Permissions') }}
                </a>

                <ul class="nav flex-column submenu {{ request()->is('admin/settings*') ? 'show' : '' }}">
                    <li class="nav-item">
                        <a href="{{ route('admin-permissions-index') }}" class="nav-link">{{ __('Index') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">{{ __('Roles Permissions') }}</a>
                    </li>
                </ul>
            </li>
            </li>
            @endcan
            @can('manage-admins')
            <li class="nav-item has-submenu">
                <a class="nav-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                    <i class="fas fa-user-shield"></i>
                    {{ __('Manage Admins') }}
                </a>

                <ul class="nav flex-column submenu {{ request()->is('admin/settings*') ? 'show' : '' }}">
                    <li class="nav-item">
                        <a href="{{ route('admins-index') }}" class="nav-link">{{ __('Index') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admins-create') }}" class="nav-link">{{ __('Create') }}</a>
                    </li>
                </ul>
            </li>
            </li>
            @endcan
        </ul>
    </nav>
</div>