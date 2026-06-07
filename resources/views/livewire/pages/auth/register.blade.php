<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
};

?>

<div>

    <!-- HEADER -->
    <div class="text-center mb-8">

        <!-- MONITOR LOGO -->
        <div
            class="mx-auto mb-5 w-24 h-24 rounded-[32px] 
            bg-gradient-to-br from-blue-500 to-indigo-600
            shadow-2xl shadow-blue-500/30
            flex items-center justify-center">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="w-12 h-12 text-white">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9.75 17L9 20.25m6-3.25l.75 3.25m-7.5 0h9M3.75 5.25h16.5A1.5 1.5 0 0121.75 6.75v9a1.5 1.5 0 01-1.5 1.5H3.75a1.5 1.5 0 01-1.5-1.5v-9a1.5 1.5 0 011.5-1.5z" />

            </svg>

        </div>

        <!-- TITLE -->
        <h2
            class="text-4xl font-black text-gray-900 dark:text-white mb-2">

            Create Account 🚀

        </h2>

        <!-- SUBTITLE -->
        <p
            class="text-gray-500 dark:text-gray-400">

            Register your new account

        </p>

    </div>

    <!-- FORM -->
    <form
        wire:submit="register"
        class="space-y-5">

        <!-- NAME -->
        <div>

            <x-input-label
                for="name"
                :value="__('Name')"
                class="text-gray-700 dark:text-gray-300 mb-2" />

            <x-text-input
                wire:model="name"
                id="name"
                class="block mt-2 w-full rounded-2xl 
                bg-white dark:bg-[#1E293B]
                border border-gray-300 dark:border-white/10
                text-gray-900 dark:text-white
                placeholder-gray-400
                focus:ring-2 focus:ring-blue-500
                focus:border-blue-500
                px-5 py-4 transition duration-300"
                type="text"
                name="name"
                placeholder="Enter your name"
                required
                autofocus
                autocomplete="name" />

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2" />

        </div>

        <!-- EMAIL -->
        <div>

            <x-input-label
                for="email"
                :value="__('Email')"
                class="text-gray-700 dark:text-gray-300 mb-2" />

            <x-text-input
                wire:model="email"
                id="email"
                class="block mt-2 w-full rounded-2xl 
                bg-white dark:bg-[#1E293B]
                border border-gray-300 dark:border-white/10
                text-gray-900 dark:text-white
                placeholder-gray-400
                focus:ring-2 focus:ring-blue-500
                focus:border-blue-500
                px-5 py-4 transition duration-300"
                type="email"
                name="email"
                placeholder="Enter your email"
                required
                autocomplete="username" />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2" />

        </div>

        <!-- PASSWORD -->
        <div>

            <x-input-label
                for="password"
                :value="__('Password')"
                class="text-gray-700 dark:text-gray-300 mb-2" />

            <x-text-input
                wire:model="password"
                id="password"
                class="block mt-2 w-full rounded-2xl 
                bg-white dark:bg-[#1E293B]
                border border-gray-300 dark:border-white/10
                text-gray-900 dark:text-white
                placeholder-gray-400
                focus:ring-2 focus:ring-blue-500
                focus:border-blue-500
                px-5 py-4 transition duration-300"
                type="password"
                name="password"
                placeholder="Enter password"
                required
                autocomplete="new-password" />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2" />

        </div>

        <!-- CONFIRM PASSWORD -->
        <div>

            <x-input-label
                for="password_confirmation"
                :value="__('Confirm Password')"
                class="text-gray-700 dark:text-gray-300 mb-2" />

            <x-text-input
                wire:model="password_confirmation"
                id="password_confirmation"
                class="block mt-2 w-full rounded-2xl 
                bg-white dark:bg-[#1E293B]
                border border-gray-300 dark:border-white/10
                text-gray-900 dark:text-white
                placeholder-gray-400
                focus:ring-2 focus:ring-blue-500
                focus:border-blue-500
                px-5 py-4 transition duration-300"
                type="password"
                name="password_confirmation"
                placeholder="Confirm password"
                required
                autocomplete="new-password" />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2" />

        </div>

        <!-- BUTTON -->
        <button
            type="submit"
            class="w-full py-4 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold text-lg shadow-xl shadow-blue-500/30 hover:scale-[1.02] transition duration-300">

            Register

        </button>

        <!-- LOGIN -->
        <div
            class="text-center text-gray-500 dark:text-gray-400 pt-2">

            Already have an account?

            <a
                href="{{ route('login') }}"
                wire:navigate
                class="text-blue-500 font-semibold hover:text-blue-600">

                Login

            </a>

        </div>

    </form>

    <!-- FOOTER -->
    <div
        class="mt-8 pt-6 border-t border-gray-200 dark:border-white/10 text-center">

        <p
            class="text-sm text-gray-500 dark:text-gray-400">

            © {{ date('Y') }} Ticketing System

        </p>

        <p
            class="text-sm text-gray-500 dark:text-gray-500 mt-1">

            Project By

            <span
                class="font-semibold text-blue-500 dark:text-blue-400">

                Gempar Priadi

            </span>

        </p>

        <!-- GITHUB -->
        <a
            href="https://github.com/GemparPriadi"
            target="_blank"
            class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/70 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:scale-105 transition duration-300 shadow-lg">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 24 24"
                class="w-5 h-5 text-gray-700 dark:text-gray-300">

                <path
                    d="M12 .5C5.648.5.5 5.648.5 12a11.5 11.5 0 0 0 7.863 10.91c.575.106.787-.25.787-.556 0-.275-.012-1.188-.018-2.156-3.2.694-3.877-1.356-3.877-1.356-.525-1.337-1.281-1.693-1.281-1.693-1.05-.718.08-.706.08-.706 1.162.081 1.774 1.193 1.774 1.193 1.031 1.768 2.706 1.257 3.366.962.106-.75.406-1.256.737-1.544-2.556-.288-5.244-1.281-5.244-5.706 0-1.262.45-2.294 1.187-3.103-.119-.288-.512-1.45.112-3.025 0 0 .969-.31 3.175 1.185a10.97 10.97 0 0 1 5.781 0c2.206-1.494 3.175-1.185 3.175-1.185.625 1.575.231 2.737.113 3.025.737.809 1.187 1.84 1.187 3.103 0 4.437-2.694 5.412-5.262 5.694.418.362.787 1.075.787 2.169 0 1.568-.013 2.831-.013 3.219 0 .306.206.668.793.555A11.503 11.503 0 0 0 23.5 12C23.5 5.648 18.352.5 12 .5Z" />

            </svg>

            <span
                class="text-sm font-medium text-gray-700 dark:text-gray-300">

                github.com/GemparPriadi

            </span>

        </a>

    </div>

</div>