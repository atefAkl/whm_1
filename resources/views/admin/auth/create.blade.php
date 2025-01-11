@extends('admin.layouts.app')
@section('title', 'Admin Register')
@section('content')
<div class="container">
    <h1 class="text-center bg-light h1">Register</h1>
    <form method="POST" action="{{ route('admin-store') }}">
        @csrf
        <div class="input-group mb-3">
            <label class="input-group-text" for="name">Name</label>
            <input id="name" type="text" class="form-control" name="name" required autofocus>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" required>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
        </div>
        <div class="input-group">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
</div>
@endsection