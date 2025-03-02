<div class="container mt-4">
    <fieldset>
        <legend>{{ __('Assign Permissions to Roles') }}</legend>
        <form id="assignPermissionsForm">
            @csrf
            <div class="mb-3">
                <label for="role" class="form-label">{{ __('Select Role') }}</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="" disabled selected>{{ __('Choose a Role') }}</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('Permissions') }}</label>
                @foreach($permissions as $group => $groupPermissions)
                    <fieldset class="border p-2">
                        <legend class="w-auto">{{ $group }}</legend>
                        @foreach($groupPermissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission{{ $permission->id }}">
                                <label class="form-check-label" for="permission{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </fieldset>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Assign Permissions') }}</button>
        </form>
    </fieldset>
</div>
