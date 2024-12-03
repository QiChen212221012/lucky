<!-- resources/views/components/admin-layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <header class="bg-indigo-600 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <h1 class="text-lg font-bold">Admin Panel</h1>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="px-4">Dashboard</a>
                <a href="{{ route('admin.reports') }}" class="px-4">Reports</a>
                <a href="{{ route('admin.comments') }}" class="px-4">Manage Comments</a>
                <a href="{{ route('logout') }}" class="px-4">Logout</a>
            </nav>
        </div>
    </header>
    <main class="container mx-auto mt-8 p-6">
        {{ $slot }}
    </main>
</body>
</html>
