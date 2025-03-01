<x-guest-layout>
    <div class="mb-4 text-sm text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-700 text-white border-gray-600 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
