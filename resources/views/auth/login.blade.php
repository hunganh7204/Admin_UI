@extends('layouts.app')
@section('content')
<div class="container py-5" style="max-width: 400px;">
    <h3 class="fw-bold text-center mb-4">Đăng nhập</h3>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form method="POST" action="{{ route('doLogin') }}" class="card shadow-sm p-4">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên đăng nhập</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
    </form>
</div>
@endsection