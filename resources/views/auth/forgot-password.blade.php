@extends('layouts.app')

@section('content')
<div class="container">
    <h1>إعادة تعيين كلمة المرور</h1>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email">البريد الإلكتروني</label>
            <input id="email" type="email" class="form-control" name="email" required autofocus>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">إرسال رابط إعادة تعيين كلمة المرور</button>
        </div>
    </form>
</div>
@endsection