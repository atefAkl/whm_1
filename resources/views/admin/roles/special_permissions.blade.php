<div class="container mt-4">
    <fieldset>
        <legend>{{ __('Manage Special Permissions') }}</legend>
        <form id="specialPermissionsForm">
            @csrf
            <div class="mb-3">
                <label for="admin" class="form-label">{{ __('Select Admin') }}</label>
                <select class="form-control" id="admin" name="admin" required>
                    <option value="" disabled selected>{{ __('Choose an Admin') }}</option>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('Special Permissions') }}</label>
                @foreach($specialPermissions as $specialPermission)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="special_permissions[]" value="{{ $specialPermission->id }}" id="specialPermission{{ $specialPermission->id }}">
                        <label class="form-check-label" for="specialPermission{{ $specialPermission->id }}">
                            {{ $specialPermission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Assign Special Permissions') }}</button>
        </form>
    </fieldset>
</div>
