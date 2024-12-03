<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Lucky Blog' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- 引用全局 CSS -->
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="header-content">
                <h1 class="logo">Lucky Blog</h1>
                <nav>
                    <ul class="nav-menu">
                        <li class="{{ Request::routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                        <li class="{{ Request::routeIs('about') ? 'active' : '' }}"><a href="{{ route('about') }}">About Us</a></li>
                        <li class="{{ Request::routeIs('post.manage') ? 'active' : '' }}"><a href="{{ route('post.manage') }}">Explore</a></li>
                        <li class="{{ Request::routeIs('post.search') ? 'active' : '' }}"><a href="{{ route('post.search') }}">Search Blogs</a></li>
                    </ul>
                </nav>
                <div class="auth-buttons">
                    @guest
                        <a href="{{ route('login') }}" class="btn login-btn">Login</a>
                        <a href="{{ route('register') }}" class="btn register-btn">Register</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn login-btn">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn register-btn">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-8">
        {{ $slot }} <!-- 动态内容插槽 -->
    </main>

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
