<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ $title ?? 'Dashboard' }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Admin Navigation -->
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('admin.dashboard') }}" class="text-lg font-bold">Admin Panel</a>
            <div class="flex space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
                <a href="{{ route('admin.comments') }}" class="hover:underline">Comments</a>
                <a href="{{ route('admin.reports') }}" class="hover:underline">Reports</a>
                <a href="{{ route('logout') }}" class="hover:underline">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-6">
        @yield('content')
    </div>

    <!-- 页脚 -->
<footer>
    <div class="container footer-container">
        <p>Stay Connected with Lucky Blog</p>
        <p>© 2024 Lucky Blog | Designed with ❤ and Care</p>
        <!-- 社交图标 -->
        <div class="social-icons">
            <a href="https://www.facebook.com" target="_blank">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://twitter.com" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.instagram.com" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.linkedin.com" target="_blank">
                <i class="fab fa-linkedin"></i>
            </a>
        </div>
    </div>
</footer>
</body>
</html>
