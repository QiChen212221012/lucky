<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-teal-700 leading-tight text-center">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-b from-teal-500 to-cyan-500 flex items-center justify-center py-12">
        <div class="bg-white w-full max-w-lg p-10 rounded-2xl shadow-lg">
            <!-- 标题 -->
            <h3 class="text-2xl font-bold text-teal-700 text-center mb-4">
                {{ __("Welcome to Your Dashboard!") }}
            </h3>

            <!-- 文案 -->
            <p class="text-gray-600 text-center mb-8">
                {{ __("You're logged in successfully. Manage your account and explore more features.") }}
            </p>

            <!-- 按钮 -->
            <div class="flex justify-center">
                <a href="{{ route('profile.edit') }}"
                   class="px-6 py-3 bg-teal-500 text-white font-semibold rounded-full shadow-md hover:bg-teal-600 transition-all duration-300">
                    {{ __("Manage Profile") }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
