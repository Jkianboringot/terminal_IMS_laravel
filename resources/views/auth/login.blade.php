<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email">
                    <strong>{{ __('Email') }}</strong>
                </x-label>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                         :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password">
                    <strong>{{ __('Password') }}</strong>
                </x-label>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                         required autocomplete="current-password" />
            </div>

            <div class="block mt-2">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
<div class="row mt-3">
    <!-- Forgot password link - left-aligned -->
    <div class="col d-flex justify-content-start mt-2">
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif
    </div>

    <!-- Login button - right-aligned -->
    <div class="col d-flex justify-content-end mb-3">
        <x-button>
            {{ __('Log in') }}
        </x-button>
    </div>
</div>



        </form>
    </x-authentication-card>
</x-guest-layout>
