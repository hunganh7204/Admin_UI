@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Thêm tài khoản</h2>
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary mb-3">Quay lại</a>
    <form action="{{ route('users.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf
        @include('users.partials.form', ['user' => null])
        <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
    </form>
</div>
@endsection