<x-guest-layout>
    <div class="mb-4 text-sm text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-white" />

            <x-text-input id="password" class="block mt-1 w-full bg-gray-700 text-white border-gray-600 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
