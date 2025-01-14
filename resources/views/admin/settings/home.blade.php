@extends('admin.layouts.app')

@section('title', __('Settings'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('General Settings') }}</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admins-settings-update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="site_name" class="form-label">{{ __('Site Name') }}</label>
                                <input type="text" class="form-control @error('site_name') is-invalid @enderror" 
                                    id="site_name" name="site_name" value="{{ old('site_name', config('app.name')) }}">
                                @error('site_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="site_email" class="form-label">{{ __('Site Email') }}</label>
                                <input type="email" class="form-control @error('site_email') is-invalid @enderror" 
                                    id="site_email" name="site_email" value="{{ old('site_email', config('mail.from.address')) }}">
                                @error('site_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="site_logo" class="form-label">{{ __('Site Logo') }}</label>
                                <input type="file" class="form-control @error('site_logo') is-invalid @enderror" 
                                    id="site_logo" name="site_logo">
                                @error('site_logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="site_favicon" class="form-label">{{ __('Site Favicon') }}</label>
                                <input type="file" class="form-control @error('site_favicon') is-invalid @enderror" 
                                    id="site_favicon" name="site_favicon">
                                @error('site_favicon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save Settings') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
