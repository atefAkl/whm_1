@extends('admin.layouts.app')

@section('title', __('Manage Permission'))
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admins-settings-home') }}">Settings</a></li>
<li class="breadcrumb-item active">{{__('Manage Permission')}}</li>
@endsection
@section('content')
<div class="container-fluid">

    <fieldset class="mt-4">
        <legend class="">
            {{__('Permissions List')}}</h3>
            <a class="ms-3" href="{{ route('admin-permissions-create') }}">
                <i class="fa fa-plus" data-bs-toggle="tooltip" data-bs-title="{{__('Create new')}}"></i>
            </a>
        </legend>

        <div class="m-3 mb-3">
            @foreach($groupedPermissions as $group => $permissions)
            <fieldset class="">
                <legend>{{ ucfirst($group) }}
                    <a class="ms-3" href="{{ route('admin-permissions-create') }}">
                        <i class="fa fa-plus" data-bs-toggle="tooltip" data-bs-title="{{__('Add permission to group')}}"></i>
                    </a>
                </legend>
                <div class="row">
                    @forelse($permissions as $permission)
                    <div class="col-md-6 px-3">
                        <form class="px-3 border-bottom" action="{{ route('admin-permissions-destroy', $permission) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <b class="permission_name">{{ $permission->name }} [ {{$permission->guard_name}} ] </b>
                            <p class="my-0 d-flex">
                                <span class="description_text" style="flex: auto">{{ $permission->description ?? 'Description not available' }}</span>
                                <span class="btn-group" style="">
                                    <a data-bs-toggle="modal" data-bs-target="#editPermissionModal" data-id="{{ $permission->id }}" href="javascript:void(0)" class="btn px-1 py-0 text-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="submit" class="btn px-1 py-0 text-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </span>
                            </p>
                        </form>
                    </div>
                    @empty
                    <div class="col-12">
                        <span class="text-center">{{ __('messages.No permissions found') }}</span>
                    </div>
                    @endforelse
                </div>
            </fieldset>
            @endforeach
        </div>
    </fieldset>
</div>

<div id="modals">
    <div class="modal fade" id="editPermissionModal" tabindex="-1" role="dialog" aria-labelledby="editPermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPermissionModalLabel">{{ __('Edit Permission') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPermissionForm" action="{{ route('admin-permissions-update', ['000']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group mb-2">
                            <label class="input-group-text" for="name">{{__('Name')}}</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $permission) }}" required>
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group mb-2">
                            <label class="input-group-text" for="guard_name">{{__('Guard Name')}}</label>
                            <select name="guard_name" id="guard_name" class="form-control @error('guard_name') is-invalid @enderror"
                                value="{{ old('guard_name', $permission) }}" required>
                                <option hidden>{{__('Select Guard')}}</option>
                                @foreach (App\Models\Permission::guards() as $key => $guard)
                                <option value="{{ $key }}">{{ $guard }}</option>
                                @endforeach
                            </select>
                            @error('guard_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group mb-2">
                            <label class="input-group-text" for="group">{{__('Group')}}</label>
                            <select name="group_name" id="group_name" class="form-control @error('group_name') is-invalid @enderror"
                                value="{{ old('group_name', $permission) }}" required>
                                <option hidden>{{__('Select Group')}}</option>
                                @foreach (App\Models\Permission::groups() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('group_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-2">
                            <label class="input-group-text" for="description">{{__('Description')}}</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $permission) }}</textarea>
                            @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="btn-group d-flex justify-content-end">
                            <a class="btn btn-outline-secondary" href="{{ route('admin-permissions-index') }}">
                                <i class="fa fa-home"></i> {{__('Go Back')}}
                            </a>
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-save"></i> {{__('Save')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="pageError"></div>


@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        document.querySelectorAll('.permission_name').forEach(permission => {
            permission.innerHTML = handlePermissionName(permission.textContent)
        })
    });

    // Form validation methods


    // Showing permission form and filling fields using ajax
    $('#editPermissionModal').on('show.bs.modal', function(event) {
        // جلب معرف الصلاحية
        var permission_id = $(event.relatedTarget).data('id');

        // جلب البيانات الخاصة بالصلاحية باستخدام AJAX
        $.ajax({

            url: '/admin/permissions/getById/' + permission_id,
            method: 'GET',
            success: function(data) {

                //replacing permission id inside the url 
                $('#editPermissionForm').attr('action', $('#editPermissionForm').attr('action').replace('000', permission_id));

                // Assign values to form fields
                $('#name').val(data.name);
                $('#group_name').val(data.group_name);
                $('#guard_name').val(data.guard_name);
                $('#description').html(data.description);
            },
            error: function(e) {
                $('#pageError').html(e);
            }
        });
    });

    const handlePermissionName = (permissionName) => {
        return permissionName.charAt(0).toUpperCase() + permissionName.replace('-', ' ').slice(1)
    }
</script>
@endpush