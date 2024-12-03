<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-b from-teal-500 to-cyan-500">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center text-teal-700">Welcome Back</h2>
            <p class="mt-2 text-center text-gray-600">Please login to access your account</p>

            <form method="POST" action="{{ route('login') }}" class="mt-6">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                    @error('email')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                    @error('password')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-teal-500 border-gray-300 rounded focus:ring-teal-400">
                    <label for="remember_me" class="ml-2 text-sm text-gray-700">Remember Me</label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-teal-500 to-cyan-500 rounded-lg hover:from-teal-600 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-400">
                    Log in
                </button>
            </form>

            <!-- Additional Links -->
            <div class="mt-4 text-sm text-center">
                <p class="text-gray-600">Don't have an account?</p>
                <a href="{{ route('register') }}" class="text-teal-600 hover:text-teal-700 font-medium">Create one now</a>
            </div>

            <!-- Forgot Password -->
            <div class="mt-2 text-sm text-center">
                <a href="{{ route('password.request') }}" class="text-teal-600 hover:text-teal-700">Forgot your password?</a>
            </div>
        </div>
    </div>
</x-guest-layout>
