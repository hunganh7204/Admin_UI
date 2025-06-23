<div class="mb-3">
    <label class="form-label">Họ tên</label>
    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $user->full_name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" name="username" class="form-control" value="{{ old('username', $user->username ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Mật khẩu{{ isset($user) ? '' : '' }}</label>
    <input type="password" name="password" class="form-control">
</div>
<div class="mb-3">
    <label class="form-label">Ảnh đại diện (URL)</label>
    <input type="text" name="avatar_url" class="form-control" value="{{ old('avatar_url', $user->avatar_url ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Vai trò</label>
    <select name="role" id="role-select" class="form-select" onchange="toggleDepartmentField()">
        <option value="teacher" {{ old('role', $user->role ?? '') == 'teacher' ? 'selected' : '' }}>Teacher</option>
        <option value="student" {{ old('role', $user->role ?? '') == 'student' ? 'selected' : '' }}>Student</option>
    </select>
</div>
<div class="mb-3" id="department-group" style="display: none;">
    <label class="form-label">Khoa</label>
    <select name="department_id" class="form-select">
        @foreach($departments as $id => $name)
            <option value="{{ $id }}" {{ old('department_id', $user->department_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Trạng thái</label>
    <select name="status" class="form-select">
        <option value="Active" {{ old('status', $user->status ?? '') == 'Active' ? 'selected' : '' }}>Active</option>
        <option value="Inactive" {{ old('status', $user->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
<script>
function toggleDepartmentField() {
    const role = document.getElementById('role-select').value;
    document.getElementById('department-group').style.display = role === 'teacher' ? 'block' : 'none';
}
window.addEventListener('DOMContentLoaded', toggleDepartmentField);
</script>
