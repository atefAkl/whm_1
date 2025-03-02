@extends('admin.layouts.app')

@section('title', 'إضافة صلاحية جديدة')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin-permissions-index') }}">Permissions</a></li>
<li class="breadcrumb-item active">{{__('New Permission')}}</li>
@endsection
@section('content')
<div class="container-fluid pt-5">

    <fieldset class="w-50 m-auto">
        <legend class="">
            {{__('Add New Permission')}}</h3>
            <a href="{{ route('admin-permissions-index') }}">
                <i class="fa fa-home"></i> {{__('Go Back')}}
            </a>
        </legend>

        <div class="form m-3 mb-3">

            <form action="{{ route('admin-permissions-store') }}" method="POST">
                @csrf
                <div class="input-group mb-2">
                    <label class="input-group-text" for="name">{{__('Name')}}</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required>
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group mb-2">
                    <label class="input-group-text" for="group">{{__('Group')}}</label>
                    <select name="group" id="group" class="form-control @error('group') is-invalid @enderror"
                        value="{{ old('group') }}" required>
                        <option value="" disabled selected>{{__('Select Group')}}</option>
                        @foreach ($groups as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('group')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-2">
                    <label class="input-group-text" for="description">{{__('Description')}}</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                        rows="3">{{ old('description') }}</textarea>
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
    </fieldset>
</div>
@endsection