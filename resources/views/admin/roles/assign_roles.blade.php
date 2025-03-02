<div class="container mt-4">
    <fieldset>
        <legend>{{ __('Assign Roles to Users') }}</legend>
        <form id="assignRolesForm">
            @csrf
            <div class="mb-3">
                <label for="user" class="form-label">{{ __('Select User') }}</label>
                <select class="form-control" id="user" name="user" required>
                    <option value="" disabled selected>{{ __('Choose a User') }}</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('Roles') }}</label>
                @foreach($roles as $role)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role{{ $role->id }}">
                        <label class="form-check-label" for="role{{ $role->id }}">
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Assign Roles') }}</button>
        </form>
    </fieldset>
</div>
