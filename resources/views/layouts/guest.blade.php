<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{
        darkMode: localStorage.getItem('theme') === 'dark'
    }"
    x-init="
        syncTheme();

        $watch('darkMode', value => {

            localStorage.setItem(
                'theme',
                value ? 'dark' : 'light'
            );

            syncTheme();

        });
    "
    :class="{ 'dark': darkMode }"
    class="scroll-smooth">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}">

    <title>
        Ticketing System
    </title>

    <!-- PRELOAD THEME -->
    <script>

        (() => {

            const theme =
                localStorage.getItem('theme');

            if (theme === 'dark') {

                document.documentElement.classList.add('dark');

            } else {

                document.documentElement.classList.remove('dark');

            }

        })();

    </script>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body
    class="font-sans antialiased bg-[#eef4ff] dark:bg-[#020617] text-gray-900 dark:text-white overflow-x-hidden transition-all duration-300">

    <!-- BACKGROUND -->
    <div
        class="fixed inset-0 overflow-hidden transition-all duration-300">

        <!-- LIGHT MODE -->
        <div
            class="absolute inset-0 bg-gradient-to-br from-[#eef4ff] via-[#f8fbff] to-[#dde7ff] dark:hidden">
        </div>

        <!-- DARK MODE -->
        <div
            class="absolute inset-0 bg-gradient-to-br from-[#020617] via-[#0B1120] to-[#111827] hidden dark:block">
        </div>

        <!-- LIGHT BLUR -->
        <div
            class="absolute top-0 left-0 w-[500px] h-[500px] bg-blue-400/20 blur-[120px] rounded-full dark:hidden">
        </div>

        <div
            class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-indigo-400/20 blur-[120px] rounded-full dark:hidden">
        </div>

        <!-- DARK BLUR -->
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500/20 blur-[120px] rounded-full hidden dark:block">
        </div>

        <div
            class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-purple-500/20 blur-[120px] rounded-full hidden dark:block">
        </div>

    </div>

    <!-- MAIN -->
    <div
        class="relative z-10 min-h-screen flex items-center justify-center px-4 lg:px-6 py-10 overflow-x-hidden">

        <div
            class="w-full max-w-7xl grid lg:grid-cols-2 gap-14 items-center">

            <!-- LEFT -->
            <div
                class="hidden lg:flex flex-col justify-center pr-10">

                <!-- TITLE -->
                <h1
                    class="text-5xl xl:text-7xl font-black leading-tight mb-6 text-gray-900 dark:text-white">

                    Ticketing

                    <span
                        class="text-blue-500 dark:text-blue-400">

                        System

                    </span>

                </h1>

                <!-- DESC -->
                <p
                    class="text-gray-600 dark:text-gray-400 text-xl leading-relaxed max-w-2xl mb-10">

                    Modern IT Helpdesk & Support Management System
                    with realtime ticket monitoring, analytics,
                    notifications, and smart dashboard.

                </p>

                <!-- IMAGE -->
                <div
                    class="relative group">

                    <img
                        src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1200&auto=format&fit=crop"
                        class="rounded-[32px] shadow-2xl border border-white/20 dark:border-white/10 transition duration-500 group-hover:scale-[1.02] w-full max-w-[750px]">

                    <!-- OVERLAY -->
                    <div
                        class="absolute inset-0 rounded-[32px] bg-gradient-to-t from-[#020617]/40 to-transparent">
                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div
                class="flex justify-center w-full">

                <div
                    class="w-full max-w-md mx-auto 
                    bg-white/70 dark:bg-white/5
                    backdrop-blur-2xl
                    border border-white/30 dark:border-white/10
                    rounded-[32px]
                    p-6 lg:p-10
                    shadow-[0_20px_60px_rgba(59,130,246,0.15)] 
                    dark:shadow-black/30
                    transition-all duration-300">

                    <!-- THEME BUTTON -->
                    <div
                        class="flex justify-end mb-4">

                        <button
                            @click="darkMode = !darkMode"
                            class="w-12 h-12 rounded-2xl bg-white dark:bg-[#1E293B] border border-gray-200 dark:border-white/10 flex items-center justify-center shadow-lg hover:scale-110 transition duration-300">

                            <span
                                x-show="!darkMode"
                                class="text-xl">

                                🌙

                            </span>

                            <span
                                x-show="darkMode"
                                class="text-xl">

                                ☀️

                            </span>

                        </button>

                    </div>

                    <!-- SLOT -->
                    {{ $slot }}

                </div>

            </div>

        </div>

    </div>

    <!-- THEME SCRIPT -->
    <script>

        window.syncTheme = function () {

            const theme =
                localStorage.getItem('theme');

            if (theme === 'dark') {

                document.documentElement.classList.add('dark');

            } else {

                document.documentElement.classList.remove('dark');

            }

        }

        // FIRST LOAD
        syncTheme();

        // LIVEWIRE NAVIGATE
        document.addEventListener(
            'livewire:navigated',
            () => {

                syncTheme();

            }
        );

    </script>

</body>

</html>