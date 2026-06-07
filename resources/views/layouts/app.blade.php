<!DOCTYPE html>

<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
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
        {{ config('app.name', 'NexaDesk') }}
    </title>

    <!-- INIT THEME -->
    <script>

        if (
            localStorage.getItem('theme') === 'dark'
        ) {

            document.documentElement.classList.add('dark');

        } else {

            document.documentElement.classList.remove('dark');

        }

    </script>

    <!-- Fonts -->
    <link
        rel="preconnect"
        href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet" />

    <!-- VITE -->
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body
    class="font-sans antialiased bg-white dark:bg-[#0B1120] text-gray-900 dark:text-white transition-all duration-300">

    <div class="min-h-screen">

        <!-- NAVIGATION -->
        <livewire:layout.navigation />

        <!-- HEADER -->
        @if (isset($header))

            <header
                class="bg-white dark:bg-[#111827] border-b border-gray-200 dark:border-gray-800 shadow">

                <div
                    class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

                    {{ $header }}

                </div>

            </header>

        @endif

        <!-- MAIN -->
        <main>

            {{ $slot }}

        </main>

    </div>
    @stack('scripts')

</body>
</html>