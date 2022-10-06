<x-guest-layout>
    <x-auth-card>

        <x-slot name="logo">
            <p class="text-blue font-sans text-6xl font-bold">Login</p>
        </x-slot>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label class="text-white text-xl" for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label class="text-white text-xl" for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 shadow-sm" name="remember">
                    <span class="ml-2 text-sm text-white">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex justify-between mt-4">
                <div class="">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-white" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        <br>
                    @endif
                    <a class="underline text-sm text-white" href="{{route('register')}}">{{__("Don't have an account?")}}</a>
                </div>
                <div class="justify-end">
                    <x-primary-button class="ml-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
