<x-guest-layout>
    <x-breeze.auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-breeze.application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-breeze.auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-breeze.auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-breeze.label for="email" :value="__('Email')" />

                <x-breeze.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-breeze.button>
                    {{ __('Email Password Reset Link') }}
                </x-breeze.button>
            </div>
        </form>
    </x-breeze.auth-card>
</x-guest-layout>
