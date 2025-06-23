@extends('layouts.app')

@section('content')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="container py-4">
    <h2 class="fw-bold mb-4">Thêm tài khoản</h2>
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary mb-3">Quay lại</a>

<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="card shadow-sm p-4">
    @csrf
    <div class="mb-3">
        <label class="form-label">Họ tên</label>
        <input type="text" name="full_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Mật khẩu</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Ảnh đại diện</label>
        <input type="file" name="avatar_file" class="form-control" accept="image/*">
    </div>
    <div class="mb-3">
        <label class="form-label">Vai trò</label>
        <select name="role" class="form-select" required>
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Trạng thái</label>
        <select name="status" class="form-select" required>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
</form>

@endsection
