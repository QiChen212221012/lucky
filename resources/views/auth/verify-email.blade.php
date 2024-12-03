<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-b from-teal-500 to-cyan-500">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
            <!-- Title -->
            <h2 class="text-2xl font-bold text-center text-teal-700 mb-4">
                {{ __('Email Verification') }}
            </h2>

            <!-- Description -->
            <p class="text-sm text-gray-600 text-center mb-6">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>

            <!-- Status Message -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 text-center">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <!-- Resend and Logout Buttons -->
            <div class="mt-4 flex items-center justify-between">
                <!-- Resend Verification Email -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white bg-teal-500 rounded-lg hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-400">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>
            </div>

            <!-- Logout Button -->
            <div class="mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-400">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
