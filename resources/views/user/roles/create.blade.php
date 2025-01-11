@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{ route('store-roles') }}" method="POST" class="m-auto mt-4 w-50">
        <h1>Add New Role</h1>
        @csrf
        <div class="input-group mb-3">
            <label class="input-group-text" for="name">Role Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="guard_name">Guard Name</label>
            <select name="guard_name" class="form-control">
                @foreach($guards as $guard)
                <option value="{{ $guard }}">{{ $guard }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Role</button>
        <h4 class="mt-4">Roles</h4>
        @if ($roles->count() > 0)
        @php $i = 1; @endphp
        @foreach ($roles as $role)
        <div class="row border my-1 py-2">
            <div class="col-auto">{{ $i++ }}</div>
            <div class="col"> <b>{{ $role->name }}</b> -> {{ $role->guard_name }}
            </div>
            <div class="col-auto buttons">
                <a href="" class=""><i class="fa fa-edit"></i></a>
                <a href="" class=""><i class="fa fa-trash text-danger"></i></a>
            </div>
        </div>
        @endforeach
        @else
        <div class="row">
            <p>No roles found.</p>
        </div>
        @endif
    </form>

</div>
@endsection