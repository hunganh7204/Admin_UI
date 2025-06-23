<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @if(session('admin_logged_in'))
    <div class="bg-dark text-white py-3 px-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Trang quản trị</h4>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mb-0">@csrf
            <button type="submit" class="btn btn-outline-light">Đăng xuất</button>
        </form>
    </div>
    @endif

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>