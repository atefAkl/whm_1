@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ __('Admin Dashboard') }}</h1>

    <div class="row">

        <!-- Admins Management -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ __('Admins Management') }}</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('admin-register') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user-plus mr-2"></i>
                            {{ __('Create New Admin') }}
                        </a>
                        <a href="{{ route('admins-index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-users-cog mr-2"></i>
                            {{ __('All Admins') }}
                        </a>
                        <a href="{{ route('admin-profile') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user-circle mr-2"></i>
                            {{ __('My Profile') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Roles & Permissions -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">{{ __('Roles & Permissions') }}</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @can('manage-roles')
                        <a href="{{ route('admin-roles-create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-plus-circle mr-2"></i>
                            {{ __('Add New Role') }}
                        </a>
                        <a href="{{ route('admin-roles-index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user-shield mr-2"></i>
                            {{ __('All Roles') }}
                        </a>
                        @endcan
                        @can('manage-permissions')
                        <a href="{{ route('admin-permissions-create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-plus-circle mr-2"></i>
                            {{ __('Add New Permission') }}
                        </a>
                        <a href="{{ route('admin-permissions-index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-key mr-2"></i>
                            {{ __('All Permissions') }}
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <!-- System Settings -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">{{ __('System Settings') }}</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @can('manage-settings')
                        <a href="{{ route('admins-settings-home') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-cogs mr-2"></i>
                            {{ __('General Settings') }}
                        </a>
                        @endcan
                        @can('view-logs')
                        <a href="{{ route('admin-logs') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-history mr-2"></i>
                            {{ __('System Logs') }}
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .list-group-item {
        border: none;
        padding: 12px 20px;
        margin-bottom: 5px;
        border-radius: 5px !important;
        transition: all 0.2s;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }

    .card-header {
        border-bottom: none;
        border-radius: 5px 5px 0 0 !important;
    }
</style>
@endpush