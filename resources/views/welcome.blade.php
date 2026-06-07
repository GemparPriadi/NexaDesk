<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="scroll-smooth">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>
        Ticketing System
    </title>

    <!-- THEME INIT -->
    <script>

        if (
            localStorage.getItem('theme') === 'dark'
        ) {

            document.documentElement.classList.add('dark');

        } else {

            document.documentElement.classList.remove('dark');

        }

    </script>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body
    class="font-sans antialiased bg-[#f4f8ff] dark:bg-[#020617] text-gray-900 dark:text-white overflow-x-hidden transition-all duration-300">

    <!-- BACKGROUND -->
    <div
        class="fixed inset-0 overflow-hidden -z-10">

        <!-- LIGHT -->
        <div
            class="absolute inset-0 bg-gradient-to-br from-[#eef4ff] via-white to-[#dbeafe] dark:hidden">
        </div>

        <!-- DARK -->
        <div
            class="absolute inset-0 bg-gradient-to-br from-[#020617] via-[#0B1120] to-[#111827] hidden dark:block">
        </div>

        <!-- BLUR -->
        <div
            class="absolute top-0 left-0 w-[500px] h-[500px] bg-blue-500/20 blur-[120px] rounded-full">
        </div>

        <div
            class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-indigo-500/20 blur-[120px] rounded-full">
        </div>

    </div>

    <!-- NAVBAR -->
    <header
        class="w-full fixed top-0 left-0 z-50 backdrop-blur-xl bg-white/60 dark:bg-[#020617]/60 border-b border-white/20 dark:border-white/10">

        <div
            class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <!-- LEFT -->
            <div
                class="flex items-center gap-4">

                <!-- MONITOR LOGO -->
                <div
                    class="w-14 h-14 rounded-2xl bg-blue-500/10 flex items-center justify-center">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="w-8 h-8 text-blue-500">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9.75 17L9 20.25m6-3.25l.75 3.25m-7.5 0h9M3.75 5.25h16.5A1.5 1.5 0 0121.75 6.75v9a1.5 1.5 0 01-1.5 1.5H3.75a1.5 1.5 0 01-1.5-1.5v-9a1.5 1.5 0 011.5-1.5z" />

                    </svg>

                </div>

                <!-- TEXT -->
                <div>

                    <h1
                        class="text-xl font-black text-gray-900 dark:text-white">

                        Ticketing System

                    </h1>

                    <p
                        class="text-sm text-gray-500 dark:text-gray-400">

                        IT Helpdesk Management

                    </p>

                </div>

            </div>

            <!-- RIGHT -->
            <div
                class="flex items-center gap-4">

                <!-- THEME BUTTON -->
                <button
                    id="theme-toggle"
                    class="w-11 h-11 rounded-2xl bg-white dark:bg-[#1E293B] border border-gray-200 dark:border-white/10 shadow-lg flex items-center justify-center hover:scale-110 transition duration-300">

                    <span
                        id="theme-icon"
                        class="text-lg">

                        🌙

                    </span>

                </button>

                @auth

                    <a
                        href="{{ url('/dashboard') }}"
                        class="px-6 py-3 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold shadow-xl shadow-blue-500/30 hover:scale-105 transition duration-300">

                        Dashboard

                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="hidden sm:flex px-5 py-3 rounded-2xl text-gray-700 dark:text-gray-300 hover:bg-white/50 dark:hover:bg-white/10 transition">

                        Login

                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="px-6 py-3 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold shadow-xl shadow-blue-500/30 hover:scale-105 transition duration-300">

                        Register

                    </a>

                @endauth

            </div>

        </div>

    </header>

    <!-- HERO -->
    <section
        class="relative min-h-screen flex items-center pt-32 pb-20 px-6">

        <div
            class="max-w-7xl mx-auto w-full grid lg:grid-cols-2 gap-16 items-center">

            <!-- LEFT -->
            <div>

                <div
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 mb-8">

                    🚀 Modern Ticket Management System

                </div>

                <h1
                    class="text-5xl sm:text-6xl xl:text-7xl font-black leading-tight mb-8 text-gray-900 dark:text-white">

                    Smart Helpdesk

                    <span
                        class="text-blue-500 dark:text-blue-400">

                        Ticketing

                    </span>

                    Platform

                </h1>

                <p
                    class="text-xl text-gray-600 dark:text-gray-400 leading-relaxed mb-10 max-w-2xl">

                    Modern IT support management platform with realtime ticket tracking, analytics dashboard, notifications, and team collaboration system.

                </p>

                <!-- BUTTON -->
                <div
                    class="flex flex-wrap gap-5">

                    <a
                        href="{{ route('login') }}"
                        class="px-8 py-4 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold shadow-2xl shadow-blue-500/30 hover:scale-105 transition duration-300">

                        Get Started

                    </a>

                    <a
                        href="#features"
                        class="px-8 py-4 rounded-2xl border border-gray-300 dark:border-white/10 text-gray-700 dark:text-gray-300 hover:bg-white/40 dark:hover:bg-white/5 transition">

                        Explore Features

                    </a>

                </div>

            </div>

            <!-- RIGHT -->
            <div
                class="relative">

                <div
                    class="absolute inset-0 bg-blue-500/20 blur-[100px] rounded-full">
                </div>

                <img
                    src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1200&auto=format&fit=crop"
                    class="relative rounded-[32px] border border-white/20 dark:border-white/10 shadow-2xl hover:scale-[1.02] transition duration-500">

            </div>

        </div>

    </section>

    <!-- FOOTER -->
    <footer
        class="relative py-10 border-t border-white/10 text-center text-gray-500 dark:text-gray-400">

        <div
            class="flex flex-col items-center gap-3">

            <!-- COPYRIGHT -->
            <p
                class="text-sm sm:text-base">

                © {{ date('Y') }} Ticketing System

            </p>

            <!-- PROJECT -->
            <p
                class="text-sm text-gray-600 dark:text-gray-500">

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
                class="inline-flex items-center gap-2 px-5 py-2 rounded-2xl bg-white/70 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:scale-105 transition duration-300 shadow-lg">

                <!-- ICON -->
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    class="w-5 h-5">

                    <path
                        d="M12 .5C5.648.5.5 5.648.5 12a11.5 11.5 0 0 0 7.863 10.91c.575.106.787-.25.787-.556 0-.275-.012-1.188-.018-2.156-3.2.694-3.877-1.356-3.877-1.356-.525-1.337-1.281-1.693-1.281-1.693-1.05-.718.08-.706.08-.706 1.162.081 1.774 1.193 1.774 1.193 1.031 1.768 2.706 1.257 3.366.962.106-.75.406-1.256.737-1.544-2.556-.288-5.244-1.281-5.244-5.706 0-1.262.45-2.294 1.187-3.103-.119-.288-.512-1.45.112-3.025 0 0 .969-.31 3.175 1.185a10.97 10.97 0 0 1 5.781 0c2.206-1.494 3.175-1.185 3.175-1.185.625 1.575.231 2.737.113 3.025.737.809 1.187 1.84 1.187 3.103 0 4.437-2.694 5.412-5.262 5.694.418.362.787 1.075.787 2.169 0 1.568-.013 2.831-.013 3.219 0 .306.206.668.793.555A11.503 11.503 0 0 0 23.5 12C23.5 5.648 18.352.5 12 .5Z" />

                </svg>

                <span
                    class="font-medium text-gray-700 dark:text-gray-300">

                    github.com/GemparPriadi

                </span>

            </a>

        </div>

    </footer>

    <!-- THEME SCRIPT -->
    <script>

        const themeToggle =
            document.getElementById('theme-toggle');

        const themeIcon =
            document.getElementById('theme-icon');

        function updateThemeIcon() {

            if (
                document.documentElement.classList.contains('dark')
            ) {

                themeIcon.innerHTML = '☀️';

            } else {

                themeIcon.innerHTML = '🌙';

            }

        }

        updateThemeIcon();

        themeToggle.addEventListener('click', () => {

            document.documentElement.classList.toggle('dark');

            if (
                document.documentElement.classList.contains('dark')
            ) {

                localStorage.setItem('theme', 'dark');

            } else {

                localStorage.setItem('theme', 'light');

            }

            updateThemeIcon();

        });

    </script>

</body>

</html>