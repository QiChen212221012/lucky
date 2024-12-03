<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-b from-teal-500 to-cyan-500">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-center text-teal-700">Create Your Account</h2>
            <p class="mt-2 text-center text-gray-600">Sign up to get started with our platform</p>

            <form method="POST" action="{{ route('register') }}" class="mt-6">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                        class="w-full px-4 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                    @error('name')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                        class="w-full px-4 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                    @error('email')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="w-full px-4 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                    @error('password')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="w-full px-4 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                    @error('password_confirmation')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-teal-500 to-cyan-500 rounded-lg hover:from-teal-600 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-400">
                    Register
                </button>
            </form>

            <!-- Additional Links -->
            <div class="mt-4 text-sm text-center">
                <p class="text-gray-600">Already have an account?</p>
                <a href="{{ route('login') }}" class="text-teal-600 hover:text-teal-700 font-medium">Log in here</a>
            </div>
        </div>
    </div>
</x-guest-layout>
