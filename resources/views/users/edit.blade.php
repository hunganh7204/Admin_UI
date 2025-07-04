@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Chỉnh sửa tài khoản</h2>
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary mb-3">Quay lại</a>

    <form action="{{ route('users.update', $user['id']) }}" method="POST" enctype="multipart/form-data" class="card shadow-sm p-4">
        @csrf
        @method('PUT')

        @include('users.partials.form', ['user' => $user, 'isEdit' => true])

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
