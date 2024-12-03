<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-b from-teal-500 to-cyan-500">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-center text-teal-700">Reset Your Password</h2>
            <p class="mt-2 text-center text-gray-600">
                Forgot your password? No problem. Just enter your email address below, and we'll send you a link to reset your password.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-sm text-center text-teal-600" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="mt-6">
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

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-teal-500 to-cyan-500 rounded-lg hover:from-teal-600 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-400">
                    Email Password Reset Link
                </button>
            </form>

            <!-- Additional Links -->
            <div class="mt-4 text-sm text-center">
                <a href="{{ route('login') }}" class="text-teal-600 hover:text-teal-700 font-medium">Back to Login</a>
            </div>
        </div>
    </div>
</x-guest-layout>
