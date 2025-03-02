@extends('layouts.app')

@section('content')
<div class="container pt-3">
    <div class="profile-edit">
        {{$admin}}

        <section class="bg-light p-3 shadowed mt-4">

            <h1>Edit Profile</h1>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </section>

        <section class="bg-light p-3 shadowed mt-4">
            <h2>Change Password</h2>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input id="current_password" type="password" class="form-control" name="current_password" required>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input id="new_password" type="password" class="form-control" name="new_password" required>
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </section>
        <section class="bg-light p-3 shadowed mt-4">
            <h2>Delete Account</h2>
            <form method="POST" action="{{ route('profile.destroy', $user) }}">
                @csrf
                @method('DELETE')

                <div class="form-group">
                    <label for="confirm">Are you sure you want to delete your account?</label>
                    <input type="checkbox" id="confirm" name="confirm" required>
                    <span>Yes, I am sure.</span>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection