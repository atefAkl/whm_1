@extends('admin.layouts.app')

@section('title', __('messages.Admins List'))

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ __('messages.Admins List') }}</h5>
            <a href="{{ route('admin-register') }}" class="btn btn-light">
                <i class="fas fa-plus-circle"></i> {{ __('messages.Add Admin') }}
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('messages.Name') }}</th>
                            <th>{{ __('messages.Email') }}</th>
                            <th>{{ __('messages.Roles') }}</th>
                            <th>{{ __('messages.Created At') }}</th>
                            <th>{{ __('messages.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                @foreach($admin->roles as $role)
                                <span class="badge badge-info">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $admin->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-success manage-roles"
                                        data-id="{{ $admin->id }}"
                                        data-name="{{ $admin->name }}"
                                        data-toggle="modal"
                                        data-target="#manageRolesModal"
                                        title="{{ __('messages.Manage Roles') }}">
                                        <i class="fas fa-user-shield"></i>
                                    </button>
                                    <a href="{{ route('edit-admin', $admin->id) }}" class="btn btn-sm btn-outline-warning" title="{{ __('messages.Edit') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger delete-admin"
                                        data-id="{{ $admin->id }}"
                                        data-name="{{ $admin->name }}"
                                        title="{{ __('messages.Delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">{{ __('messages.No admins found') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Manage Roles Modal -->
<div class="modal fade" id="manageRolesModal" tabindex="-1" role="dialog" aria-labelledby="manageRolesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageRolesModalLabel">{{ __('Manage Roles') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="manageRolesForm" action="{{ route('admin-assign-roles') }}" method="POST">
                @csrf
                <input type="hidden" name="admin_id" id="adminId">
                <div class="modal-body">
                    <p>{{ __('Managing roles for') }}: <span id="adminName"></span></p>
                    <div class="roles-list">
                        @foreach($roles as $role)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                                id="role_{{ $role->id }}"
                                name="roles[]"
                                value="{{ $role->name }}">
                            <label class="custom-control-label" for="role_{{ $role->id }}">
                                {{ $role->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .badge {
        margin-right: 5px;
    }

    .btn-group {
        gap: 5px;
    }

    .roles-list {
        max-height: 300px;
        overflow-y: auto;
    }

    .custom-checkbox {
        margin-bottom: 10px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle manage roles button click
        $('.manage-roles').click(function() {
            var adminId = $(this).data('id');
            var adminName = $(this).data('name');

            $('#adminId').val(adminId);
            $('#adminName').text(adminName);

            // Reset checkboxes
            $('.custom-control-input').prop('checked', false);

            // Get admin's current roles and check corresponding checkboxes
            $.get('/admin/get-admin-roles/' + adminId, function(roles) {
                roles.forEach(function(roleId) {
                    $('#role_' + roleId).prop('checked', true);
                });
            });
        });

        // Handle delete button click
        $('.delete-admin').click(function() {
            var adminId = $(this).data('id');
            var adminName = $(this).data('name');

            if (confirm('{{ __("messages.Are you sure you want to delete") }} ' + adminName + '?')) {
                $.ajax({
                    url: '{{ route("destroy-admin") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        admin_id: adminId
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }
        });
    });
</script>
@endpush