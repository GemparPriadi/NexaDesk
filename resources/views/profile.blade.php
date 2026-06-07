<x-app-layout>

    <div
        class="min-h-screen bg-white dark:bg-[#020617] py-10">

        <div
            class="max-w-7xl mx-auto px-6 space-y-8">

            <!-- ===================================== -->
            <!-- HEADER -->
            <!-- ===================================== -->

            <div
                class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                <div>

                    <h1
                        class="text-4xl font-black text-gray-900 dark:text-white">

                        My Profile

                    </h1>

                    <p
                        class="text-gray-500 dark:text-gray-400 mt-2">

                        Manage your account settings & security

                    </p>

                </div>

                <!-- ROLE -->
                <div
                    class="px-5 py-3 rounded-2xl
                    bg-blue-500/10
                    border border-blue-500/20
                    text-blue-500
                    font-bold
                    w-fit">

                    {{ ucfirst(auth()->user()->role) }}

                </div>

            </div>

            <!-- ===================================== -->
            <!-- PROFILE CARD -->
            <!-- ===================================== -->

            <div
                class="relative overflow-hidden rounded-[32px]
                bg-white dark:bg-[#111827]
                border border-gray-200 dark:border-white/10
                shadow-2xl p-8">

                <!-- BLUR -->
                <div
                    class="absolute top-0 right-0 w-72 h-72 bg-blue-500/10 blur-[120px] rounded-full">
                </div>

                <div
                    class="relative flex flex-col lg:flex-row items-center gap-8">

                    <!-- AVATAR -->
                    <div
                        class="relative">

                        @if(auth()->user()->avatar)

                            <img
                                src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                class="w-36 h-36 rounded-[32px] object-cover border-4 border-white/10 shadow-2xl shadow-blue-500/20">

                        @else

                            <div
                                class="w-36 h-36 rounded-[32px]
                                bg-gradient-to-br from-blue-500 to-indigo-600
                                flex items-center justify-center
                                shadow-2xl shadow-blue-500/30">

                                <span
                                    class="text-6xl font-black text-white">

                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                                </span>

                            </div>

                        @endif

                        <!-- ONLINE -->
                        <div
                            class="absolute bottom-2 right-2 w-6 h-6 rounded-full bg-green-500 border-4 border-[#111827]">
                        </div>

                    </div>

                    <!-- INFO -->
                    <div
                        class="flex-1 text-center lg:text-left">

                        <h2
                            class="text-4xl font-black text-gray-900 dark:text-white">

                            {{ auth()->user()->name }}

                        </h2>

                        <p
                            class="text-gray-500 dark:text-gray-400 mt-2 text-lg">

                            {{ auth()->user()->email }}

                        </p>

                        <div
                            class="mt-5 flex flex-wrap gap-3 justify-center lg:justify-start">

                            <div
                                class="px-4 py-2 rounded-2xl
                                bg-emerald-500/10
                                border border-emerald-500/20
                                text-emerald-500 font-semibold">

                                Active Account

                            </div>

                            <div
                                class="px-4 py-2 rounded-2xl
                                bg-blue-500/10
                                border border-blue-500/20
                                text-blue-500 font-semibold">

                                {{ ucfirst(auth()->user()->role) }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ===================================== -->
            <!-- UPDATE PROFILE -->
            <!-- ===================================== -->

            <div
                class="rounded-[32px]
                bg-white dark:bg-[#111827]
                border border-gray-200 dark:border-white/10
                shadow-2xl p-8">

                <div class="mb-8">

                    <h2
                        class="text-3xl font-black text-gray-900 dark:text-white">

                        Update Profile

                    </h2>

                    <p
                        class="text-gray-500 dark:text-gray-400 mt-2">

                        Change your personal information & profile photo

                    </p>

                </div>

                <div
                    class="max-w-3xl">

                    <livewire:profile.update-profile-information-form />

                </div>

            </div>

            <!-- ===================================== -->
            <!-- PASSWORD -->
            <!-- ===================================== -->

            <div
                class="rounded-[32px]
                bg-white dark:bg-[#111827]
                border border-gray-200 dark:border-white/10
                shadow-2xl p-8">

                <div class="mb-8">

                    <h2
                        class="text-3xl font-black text-gray-900 dark:text-white">

                        Security Settings

                    </h2>

                    <p
                        class="text-gray-500 dark:text-gray-400 mt-2">

                        Update your password securely

                    </p>

                </div>

                <div
                    class="max-w-3xl">

                    <livewire:profile.update-password-form />

                </div>

            </div>

            <!-- ===================================== -->
            <!-- DELETE -->
            <!-- ===================================== -->

            <div
                class="rounded-[32px]
                bg-red-500/5
                border border-red-500/20
                shadow-2xl p-8">

                <div class="mb-8">

                    <h2
                        class="text-3xl font-black text-red-500">

                        Danger Zone

                    </h2>

                    <p
                        class="text-gray-500 dark:text-gray-400 mt-2">

                        Permanently delete your account

                    </p>

                </div>

                <div
                    class="max-w-3xl">

                    <livewire:profile.delete-user-form />

                </div>

            </div>

        </div>

    </div>

    <!-- ===================================== -->
    <!-- SUCCESS MODAL -->
    <!-- ===================================== -->

    <div
        x-data="{
            show: false,
            message: ''
        }"

        x-on:profile-updated.window="
            show = true;
            message = 'Profile updated successfully ✨';

            setTimeout(() => show = false, 2500);
        "

        x-on:avatar-updated.window="
            show = true;
            message = 'Profile photo updated 📸';

            setTimeout(() => show = false, 2500);
        "

        x-on:password-updated.window="
            show = true;
            message = 'Password updated successfully 🔐';

            setTimeout(() => show = false, 2500);
        "

        x-show="show"

        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90 translate-y-10"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"

        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"

        class="fixed inset-0 z-[9999]
        flex items-center justify-center
        bg-black/40 backdrop-blur-sm"

        style="display:none;"
    >

        <div
            class="w-full max-w-md
            rounded-[32px]
            bg-[#0F172A]
            border border-emerald-500/20
            shadow-[0_0_80px_rgba(16,185,129,0.3)]
            p-8 text-center relative overflow-hidden">

            <!-- BLUR -->
            <div
                class="absolute inset-0 bg-emerald-500/5 blur-[100px]">
            </div>

            <!-- ICON -->
            <div
                class="relative mx-auto w-24 h-24 rounded-full
                bg-emerald-500/20
                flex items-center justify-center
                mb-6 animate-bounce">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2.5"
                    stroke="currentColor"
                    class="w-12 h-12 text-emerald-400">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4.5 12.75l6 6 9-13.5" />

                </svg>

            </div>

            <!-- TEXT -->
            <h2
                class="relative text-4xl font-black text-white mb-3">

                Success 🎉

            </h2>

            <p
                class="relative text-gray-300 text-lg"
                x-text="message">

            </p>

            <!-- LINE -->
            <div
                class="relative mt-8 w-full h-2 rounded-full bg-white/10 overflow-hidden">

                <div
                    class="h-full bg-emerald-400 animate-pulse rounded-full"
                    style="width:100%">
                </div>

            </div>

        </div>

    </div>

</x-app-layout>