<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 240px;
            background-color: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .navbar-custom {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4 class="text-center py-3">ITECH ADMIN</h4>
        <a href="{{ route('admin.dashboard') }}">🏠 Dashboard</a>
        <a href="{{ route('admin.artikel.index') }}">📝 Edukasi</a>
        <a href="{{ route('admin.gambar.index') }}">🖼️ Gambar Edukasi</a>
        {{-- <a href="{{ route('admin.courses.index') }}">📚 Programming Edukasi</a> --}}
        <a href="{{ route('admin.feedback.index') }}">📩 Feedback User</a>
        <a href="{{ url('admin/quiz') }}">📰 Manajemen Kuis</a>
        <a href="{{ route('admin.postingan.index') }}">📰 Postingan User</a>
        <a href="{{ route('admin.users.index') }}">👥 Manajemen User</a>
        <form action="{{ route('admin.logout') }}" method="POST" class="px-3 mt-3">
            @csrf
            <button class="btn btn-danger btn-sm w-100">Logout</button>
        </form>
    </div>


    <div class="content">
        <nav class="navbar navbar-expand navbar-light navbar-custom mb-4">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h4">Admin Panel</span>
                <form action="{{ route('admin.logout') }}" method="POST" class="ms-auto">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </nav>


        @yield('content')
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
