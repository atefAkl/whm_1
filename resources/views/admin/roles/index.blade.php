@extends('admin.layouts.app')

@section('title', 'إدارة الأدوار')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin-dashboard-home') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Manage Roles</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">الأدوار</h3>
                    <div class="card-tools">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                            <i class="fas fa-plus"></i> إضافة دور جديد
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <fieldset>
                        <legend>{{ __('Roles Management') }}</legend>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Role Name') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editRoleModal" data-id="{{ $role->id }}">{{ __('Edit') }}</button>
                                        <button class="btn btn-danger" onclick="confirmDelete({{ $role->id }})">{{ __('Delete') }}</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleModalLabel">{{ __('Add New Role') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addRoleForm">
                    @csrf
                    <div class="mb-3">
                        <label for="roleName" class="form-label">{{ __('Role Name') }}</label>
                        <input type="text" class="form-control" id="roleName" name="roleName" required>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoleModalLabel">{{ __('Edit Role') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editRoleForm">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editRoleName" class="form-label">{{ __('Role Name') }}</label>
                        <input type="text" class="form-control" id="editRoleName" name="editRoleName" required>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection