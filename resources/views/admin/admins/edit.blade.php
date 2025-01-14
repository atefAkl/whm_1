@extends('admin.layouts.app')
@section('title', 'Edit Admin Information')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ __('Edit Admin Information') }}</h5>
            <a href="{{ route('admins-index') }}" class="btn btn-light">
                <i class="fas fa-home"></i> {{ __('Back to Admins') }}
            </a>
        </div>
        <div class="card-body">
            <fieldset class="border p-3">
                <legend class="py-1 px-4 h5 bg-light w-auto shadow-sm border">
                    {{ __('Admin Information') }}
                </legend>
                <form action="{{ route('update-admin', $admin->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-2">
                        <label class="input-group-text" for="name">{{__('Change User Name')}}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" required>
                    </div>
                    <div class="input-group mb-2">
                        <label class="input-group-text" for="email">{{__('Change Email')}}</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" required>
                    </div>
                    <div class="input-group mb-2">
                        <label class="input-group-text" for="password">{{__('Password')}}</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                </form>
            </fieldset>
            <fieldset class="border p-3 mt-3">
                <legend class="py-1 px-4 h5 bg-light w-auto shadow-sm border">
                    {{ __('Change Admin Password') }}
                </legend>
                <form action="{{ route('update-admin-password', $admin->id) }}" method="POST">
                    @csrf

                    <div class="input-group mb-2">
                        <label class="input-group-text" for="old_password">{{__('Old Password')}}</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                    </div>
                    <div class="input-group mb-2">
                        <label class="input-group-text" for="password">{{__('New Password')}}</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="input-group mb-2">
                        <label class="input-group-text" for="password_confirmation">{{__('Confirm Password')}}</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                </form>
            </fieldset>
        </div>
    </div>
</div>

@endsection