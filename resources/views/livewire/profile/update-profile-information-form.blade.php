<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Livewire\Volt\Component;

new class extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';

    public $avatar;

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFILE INFO
    |--------------------------------------------------------------------------
    */

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
        ]);

        $user->update($validated);

        $this->dispatch('profile-updated');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE AVATAR
    |--------------------------------------------------------------------------
    */

    public function updateAvatar(): void
    {
        $this->validate([
            'avatar' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        $path = $this->avatar->store(
            'avatars',
            'public'
        );

        $user->update([
            'avatar' => $path,
        ]);

        $this->dispatch('avatar-updated');
    }
};

?>

<div class="space-y-8">

    <!-- ========================================= -->
    <!-- FOTO PROFIL -->
    <!-- ========================================= -->

    <div
        class="rounded-[30px]
        border border-white/10
        bg-white/5
        backdrop-blur-2xl
        p-8">

        <div
            class="flex items-center justify-between mb-6">

            <div>

                <h2
                    class="text-2xl font-black text-white">

                    Profile Photo

                </h2>

                <p
                    class="text-gray-400 mt-1">

                    Upload your avatar photo

                </p>

            </div>

        </div>

        <div
            class="flex flex-col lg:flex-row items-center gap-8">

            <!-- AVATAR -->
            <div
                class="relative group">

                @if(auth()->user()->avatar)

                    <img
                        src="{{ asset('storage/' . auth()->user()->avatar) }}"
                        class="w-40 h-40 rounded-[35px] object-cover border-4 border-white/10 shadow-2xl">

                @else

                    <div
                        class="w-40 h-40 rounded-[35px]
                        bg-gradient-to-br from-blue-500 to-indigo-600
                        flex items-center justify-center
                        shadow-2xl">

                        <span
                            class="text-6xl font-black text-white">

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                        </span>

                    </div>

                @endif

                <!-- ONLINE -->
                <div
                    class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 rounded-full border-4 border-[#0F172A]">
                </div>

            </div>

            <!-- UPLOAD -->
            <div
                class="flex-1 w-full">

                <form
                    wire:submit="updateAvatar"
                    class="space-y-5">

                    <div>

                        <label
                            class="block text-sm font-semibold text-gray-300 mb-3">

                            Upload New Photo

                        </label>

                        <input
                            type="file"
                            wire:model="avatar"
                            class="block w-full text-sm text-gray-400
                            file:mr-4
                            file:py-3
                            file:px-6
                            file:rounded-2xl
                            file:border-0
                            file:bg-blue-500
                            file:text-white
                            hover:file:bg-blue-600
                            file:font-semibold
                            transition">

                    </div>

                    @error('avatar')

                        <p
                            class="text-red-500 text-sm">

                            {{ $message }}

                        </p>

                    @enderror

                    <button
                        type="submit"
                        class="px-6 py-3 rounded-2xl
                        bg-gradient-to-r from-blue-500 to-indigo-600
                        text-white font-bold
                        shadow-xl shadow-blue-500/20
                        hover:scale-105
                        transition">

                        Save Photo

                    </button>

                </form>

            </div>

        </div>

    </div>

    <!-- ========================================= -->
    <!-- INFORMASI PROFILE -->
    <!-- ========================================= -->

    <div
        class="rounded-[30px]
        border border-white/10
        bg-white/5
        backdrop-blur-2xl
        p-8">

        <div
            class="mb-8">

            <h2
                class="text-2xl font-black text-white">

                Account Information

            </h2>

            <p
                class="text-gray-400 mt-1">

                Update your personal information

            </p>

        </div>

        <form
            wire:submit="updateProfileInformation"
            class="space-y-6">

            <!-- NAME -->
            <div>

                <x-input-label
                    for="name"
                    value="Name"
                    class="mb-2 text-gray-300" />

                <x-text-input
                    wire:model="name"
                    id="name"
                    type="text"
                    class="w-full rounded-2xl
                    bg-[#0F172A]
                    border border-white/10
                    text-white
                    px-5 py-4" />

            </div>

            <!-- EMAIL -->
            <div>

                <x-input-label
                    for="email"
                    value="Email"
                    class="mb-2 text-gray-300" />

                <x-text-input
                    wire:model="email"
                    id="email"
                    type="email"
                    class="w-full rounded-2xl
                    bg-[#0F172A]
                    border border-white/10
                    text-white
                    px-5 py-4" />

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
                    transition">

                    Save Changes

                </button>

            </div>

        </form>

    </div>
        <!-- ========================================= -->
        <!-- SUCCESS MODAL CENTER -->
        <!-- ========================================= -->

        <div
            x-data="{ show: false, message: '' }"

            x-on:profile-updated.window="
                show = true;
                message = 'Profile updated successfully ✅';

                setTimeout(() => show = false, 2500);
            "

            x-on:avatar-updated.window="
                show = true;
                message = 'Profile photo updated successfully 🖼️';

                setTimeout(() => show = false, 2500);
            "

            x-show="show"

            class="fixed inset-0 z-[9999] flex items-center justify-center">

            <!-- BACKDROP -->
            <div
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"

                class="absolute inset-0 bg-black/60 backdrop-blur-md">
            </div>

            <!-- MODAL -->
            <div
                x-show="show"

                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 scale-75 rotate-[-8deg]"
                x-transition:enter-end="opacity-100 scale-100 rotate-0"

                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-75"

                class="relative w-full max-w-md mx-4">

                <div
                    class="rounded-[35px]
                    border border-emerald-500/20
                    bg-[#0F172A]/95
                    backdrop-blur-2xl
                    p-10
                    shadow-[0_20px_80px_rgba(16,185,129,0.35)]">

                    <!-- ICON -->
                    <div
                        class="mx-auto mb-6
                        w-28 h-28
                        rounded-full
                        bg-gradient-to-br from-emerald-400 to-green-600
                        flex items-center justify-center
                        shadow-2xl shadow-emerald-500/40
                        animate-bounce">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2.5"
                            stroke="currentColor"
                            class="w-14 h-14 text-white">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.5 12.75l6 6 9-13.5" />

                        </svg>

                    </div>

                    <!-- TITLE -->
                    <h2
                        class="text-3xl font-black text-center text-white">

                        Success 🎉

                    </h2>

                    <!-- MESSAGE -->
                    <p
                        x-text="message"
                        class="mt-3 text-center text-gray-300 text-lg leading-relaxed">
                    </p>

                    <!-- LOADING BAR -->
                    <div
                        class="mt-8 w-full h-2 rounded-full bg-white/10 overflow-hidden">

                        <div
                            class="h-full bg-gradient-to-r from-emerald-400 to-green-500 animate-pulse"
                            style="width: 100%">
                        </div>

                    </div>

                </div>

            </div>

        </div>
</div>