@extends('admin.layouts.app')

@section('title', __('Profile'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Profile Information -->
        <div class="col-md-6">

            <fieldset class="border position-relative mt-5 pt-4">
                <legend class="position-absolute bg-light w-auto border shadow-sm py-2 px-3" style="top: -20px; left: 15px;">
                    <h5 class="mb-0">{{ __('Profile Information') }}</h5>
                </legend>
                <div class="card-body">
                    <form class="needs-validation m-3" action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="input-group mb-2">
                            <label class="input-group-text" for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-2">
                            <label class="input-group-text" for="email">{{ __('Email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                            @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-2">
                            <label class="input-group-text" for="phone">{{ __('Phone') }}</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                id="phone" name="phone" value="{{ old('phone', $admin->profile) }}">
                            @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>

        <!-- Change Password -->
        <div class="col-md-6">
            <fieldset class="border position-relative mt-5 pt-4">
                <legend class="position-absolute bg-light w-auto border shadow-sm py-2 px-3" style="top: -20px; left: 15px;">
                    <h5 class="mb-0">{{ __('Change Password') }}</h5>
                </legend>
                <div class="card-body m-3">
                    <form action="{{ route('admin.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="input-group mb-2">
                            <label class="input-group-text" for="old_password">{{ __('Current Password') }}</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                id="old_password" name="old_password" required>
                            @error('old_password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-2">
                            <label class="input-group-text" for="password">{{ __('New Password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-2">
                            <label class="input-group-text" for="password_confirmation">{{ __('Confirm New Password') }}</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation" required>
                            @error('password_confirmation')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Change Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>

        <!-- Settings -->

        <hr class="hr">
        <h4 class="mb-0">{{ __('Settings') }}</h4>
        <div class="col-md-6">
            <fieldset class="border position-relative mt-5 pt-4">
                <legend class="position-absolute bg-light w-auto border shadow-sm py-2 px-3" style="top: -20px; left: 15px;">
                    <h5 class="mb-0">{{ __('Settings') }}</h5>
                </legend>
                <div class="card-body m-3">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-text text-muted">{{ __('Enable or disable notifications') }}</div>
                        <div class="input-group mb-2">
                            <div class="input-group-text" class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"
                                    id="notification_enabled" name="notification_enabled"
                                    {{ $admin->settings->notification_enabled ?? false ? 'checked' : '' }}>
                                <label class="custom-control-label" for="notification_enabled">
                                    {{ __('Enable Notifications') }}
                                </label>
                            </div>
                        </div>

                        <div class="input-group mb-2">
                            <label class="input-group-text" for="theme">{{ __('Theme') }}</label>
                            <select class="form-control" id="theme" name="theme">
                                <option value="light" {{ ($admin->settings->theme ?? 'light') == 'light' ? 'selected' : '' }}>
                                    {{ __('Light') }}
                                </option>
                                <option value="dark" {{ ($admin->settings->theme ?? 'light') == 'dark' ? 'selected' : '' }}>
                                    {{ __('Dark') }}
                                </option>
                            </select>
                        </div>

                        <div class="input-group mb-2">
                            <label class="input-group-text" for="language">{{ __('Language') }}</label>
                            <select class="form-control" id="language" name="language">
                                <option value="ar" {{ ($admin->settings->language ?? 'ar') == 'ar' ? 'selected' : '' }}>
                                    {{ __('Arabic') }}
                                </option>
                                <option value="en" {{ ($admin->settings->language ?? 'ar') == 'en' ? 'selected' : '' }}>
                                    {{ __('English') }}
                                </option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Settings') }}
                            </button>
                        </div>
                    </form>
                </div>
            </fieldset>


        </div>
    </div>
    @endsection

    @push('scripts')
    <script>
        // Add any JavaScript functionality here if needed
    </script>
    @endpush