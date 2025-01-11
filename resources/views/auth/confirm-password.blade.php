@extends('layouts.app')

@section('content')
<div class="container">
    <h1>تأكيد كلمة المرور</h1>
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="form-group">
            <label for="password">كلمة المرور</label>
            <input id="password" type="password" class="form-control" name="password" required autofocus>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">تأكيد</button>
        </div>
    </form>
</div>
@endsection