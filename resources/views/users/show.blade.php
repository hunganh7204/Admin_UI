@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Thông tin người dùng</h2>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Quay lại</a>
    </div>
    <div class="card shadow-sm p-4">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{ $user['avatar_url'] ?? 'https://via.placeholder.com/200' }}" alt="Avatar" class="img-thumbnail rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
            </div>
            <div class="col-md-8">
                <h4 class="mb-3">Họ tên: {{ $user['fullname'] }}</h4>
                <p><strong>Username:</strong> {{ $user['username'] }}</p>
                <p><strong>Vai trò:</strong> {{ ucfirst($user['role']) }}</p>
                <p><strong>Trạng thái:</strong> {{ $user['status'] }}</p>
                <p><strong>Ngày tạo tài khoản:</strong> {{ \Carbon\Carbon::parse($user['createdAt'])->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection