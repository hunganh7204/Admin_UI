<div class="mb-3">
    <label class="form-label">Họ tên</label>
    <input type="text" name="full_name" class="form-control"
        value="{{ old('full_name', $user['fullname'] ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" name="username" class="form-control"
        value="{{ old('username', $user['username'] ?? '') }}" required>
</div>

{{-- Nếu là trang tạo mới thì hiện ô nhập mật khẩu --}}
@if(empty($isEdit))
<div class="mb-3">
    <label class="form-label">Mật khẩu</label>
    <input type="password" name="password" class="form-control" required>
</div>
@endif
@if(!empty($user['avatar_url']))
    <div class="mb-3">
        <label class="form-label">Ảnh hiện tại:</label><br>
        <img src="{{ $user['avatar_url'] }}" alt="avatar" style="width: 120px; height: 120px; object-fit: cover;" class="img-thumbnail mb-2">
    </div>
@endif
<div class="mb-3">
    <label class="form-label">Ảnh đại diện</label>
    <input type="file" name="avatar_file" class="form-control" accept="image/*">
</div>
<div class="mb-3">
    <label class="form-label">Vai trò</label>
    <select name="role" class="form-select" required>
        @foreach(['teacher' => 'Teacher', 'student' => 'Student', 'admin' => 'Admin'] as $key => $label)
            <option value="{{ $key }}"
                {{ old('role', strtolower($user['role'] ?? '')) == $key ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Trạng thái</label>
    <select name="status" class="form-select" required>
        @foreach(['Active' => 'Active', 'Inactive' => 'Inactive'] as $key => $label)
            <option value="{{ $key }}"
                {{ old('status', ucfirst(strtolower($user['status'] ?? ''))) == $key ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>
