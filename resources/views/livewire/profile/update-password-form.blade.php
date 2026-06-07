<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /*
    |--------------------------------------------------------------------------
    | UPDATE PASSWORD
    |--------------------------------------------------------------------------
    */

    public function updatePassword(): void
    {
        try {

            $validated = $this->validate([

                'current_password' => [
                    'required',
                    'string',
                    'current_password'
                ],

                'password' => [
                    'required',
                    'string',
                    Password::defaults(),
                    'confirmed'
                ],

            ]);

        } catch (ValidationException $e) {

            $this->reset(
                'current_password',
                'password',
                'password_confirmation'
            );

            throw $e;

        }

        Auth::user()->update([

            'password' => Hash::make(
                $validated['password']
            ),

        ]);

        $this->reset(
            'current_password',
            'password',
            'password_confirmation'
        );

        /*
        |--------------------------------------------------------------------------
        | SUCCESS MODAL EVENT
        |--------------------------------------------------------------------------
        */

        $this->dispatch('password-updated');
    }
};

?>

<section>

    <!-- HEADER -->
    <header class="mb-8">

        <h2
            class="text-2xl font-black text-white">

            Security Settings

        </h2>

        <p
            class="mt-2 text-gray-400">

            Update your password securely

        </p>

    </header>

    <!-- FORM -->
    <form
        wire:submit="updatePassword"
        class="space-y-6">

        <!-- CURRENT PASSWORD -->
        <div>

            <x-input-label
                for="update_password_current_password"
                :value="__('Current Password')"
                class="mb-2 text-gray-300" />

            <x-text-input
                wire:model="current_password"
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"

                class="w-full rounded-2xl
                bg-[#0F172A]
                border border-white/10
                text-white
                placeholder-gray-500
                px-5 py-4
                focus:border-blue-500
                focus:ring-blue-500" />

            <x-input-error
                :messages="$errors->get('current_password')"
                class="mt-2" />

        </div>

        <!-- NEW PASSWORD -->
        <div>

            <x-input-label
                for="update_password_password"
                :value="__('New Password')"
                class="mb-2 text-gray-300" />

            <x-text-input
                wire:model="password"
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"

                class="w-full rounded-2xl
                bg-[#0F172A]
                border border-white/10
                text-white
                placeholder-gray-500
                px-5 py-4
                focus:border-blue-500
                focus:ring-blue-500" />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2" />

        </div>

        <!-- CONFIRM PASSWORD -->
        <div>

            <x-input-label
                for="update_password_password_confirmation"
                :value="__('Confirm Password')"
                class="mb-2 text-gray-300" />

            <x-text-input
                wire:model="password_confirmation"
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"

                class="w-full rounded-2xl
                bg-[#0F172A]
                border border-white/10
                text-white
                placeholder-gray-500
                px-5 py-4
                focus:border-blue-500
                focus:ring-blue-500" />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2" />

        </div>

        <!-- BUTTON -->
        <div>

            <button
                type="submit"

                class="px-6 py-3 rounded-2xl
                bg-gradient-to-r from-blue-500 to-indigo-600
                text-white font-bold
                shadow-xl shadow-blue-500/20
                hover:scale-105
                transition duration-300">

                Update Password

            </button>

        </div>

    </form>

</section>