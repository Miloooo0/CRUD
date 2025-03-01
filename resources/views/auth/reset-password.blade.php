<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="bg-[#212121] p-8 rounded-lg shadow-lg">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full bg-[#333333] text-white border border-gray-600 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-white" />
            <x-text-input id="password" class="block mt-1 w-full bg-[#333333] text-white border border-gray-600 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-[#333333] text-white border border-gray-600 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-indigo-500 hover:bg-indigo-700 focus:ring-indigo-500">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
