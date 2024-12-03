<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
        <!-- Welcome Section -->
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">
            Welcome, {{ Auth::user()->name }}!
        </h1>
        <p class="mb-6 text-gray-600 dark:text-gray-400">
            You have administrative access. Use the dashboard below to manage the application.
        </p>

        <!-- Statistics Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Total Comments -->
            <div class="bg-yellow-100 p-4 rounded-lg shadow dark:bg-gray-700">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Comments</h2>
                <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $commentCount }}</p>
            </div>

            <!-- Reported Comments -->
            <div class="bg-red-100 p-4 rounded-lg shadow dark:bg-gray-700">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Reported Comments</h2>
                <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $reportedCommentCount }}</p>
            </div>
        </div>

        <!-- Management Links -->
        <div class="mt-8">
            <h3 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-200">Manage</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Comments Management -->
                <a href="{{ route('admin.comments') }}" class="block bg-yellow-500 text-white p-4 rounded-lg shadow hover:bg-yellow-600 text-center">
                    Manage Comments
                </a>

                <!-- Reported Comments Management -->
                <a href="{{ route('admin.reports') }}" class="block bg-red-500 text-white p-4 rounded-lg shadow hover:bg-red-600 text-center">
                    Manage Reported Comments
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
