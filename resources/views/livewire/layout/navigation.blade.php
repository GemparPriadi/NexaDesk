<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/');
    }
};

?>

<nav
    x-data="{
        open: false,
        notifOpen: false,
        profileOpen: false
    }"

    class="sticky top-0 z-50
    bg-white/70 dark:bg-[#0B1120]/80
    backdrop-blur-2xl
    border-b border-gray-200 dark:border-white/10
    transition-all duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-20">

            <!-- ===================================== -->
            <!-- LEFT -->
            <!-- ===================================== -->

            <div class="flex items-center gap-10">

                <!-- LOGO -->
                <a
                    href="{{ route('dashboard') }}"
                    class="flex items-center gap-4">

                    <div
                        class="w-12 h-12 rounded-2xl
                        bg-gradient-to-br from-blue-500 to-indigo-600
                        flex items-center justify-center
                        shadow-lg shadow-blue-500/30">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="w-6 h-6 text-white">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9.75 17L9 20.25m6-3.25l.75 3.25m-7.5 0h9M3.75 5.25h16.5A1.5 1.5 0 0121.75 6.75v9a1.5 1.5 0 01-1.5 1.5H3.75a1.5 1.5 0 01-1.5-1.5v-9a1.5 1.5 0 011.5-1.5z" />

                        </svg>

                    </div>

                    <div>

                        <h1
                            class="text-lg font-black text-gray-900 dark:text-white leading-none">

                            Ticketing

                        </h1>

                        <p
                            class="text-xs text-gray-500 dark:text-gray-400 mt-1">

                            Helpdesk System

                        </p>

                    </div>

                </a>

                <!-- NAVIGATION -->
                <div
                    class="hidden md:flex items-center gap-2">

                    <!-- DASHBOARD -->
                    <a
                        href="{{ route('dashboard') }}"

                        class="
                        px-5 py-3 rounded-2xl
                        text-sm font-semibold
                        transition

                        {{ request()->routeIs('dashboard')
                            ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30'
                            : 'text-gray-600 dark:text-gray-300 hover:bg-white/10'
                        }}
                        ">

                        Dashboard

                    </a>

                    <!-- TICKET -->
                    <a
                        href="{{ route('tickets.index') }}"

                        class="
                        px-5 py-3 rounded-2xl
                        text-sm font-semibold
                        transition

                        {{ request()->routeIs('tickets.*')
                            ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30'
                            : 'text-gray-600 dark:text-gray-300 hover:bg-white/10'
                        }}
                        ">

                        Ticket

                    </a>

                    <!-- ADMIN -->
                    @if(auth()->user()->isAdmin())

                        <a
                            href="{{ route('admin.dashboard') }}"

                            class="
                            px-5 py-3 rounded-2xl
                            text-sm font-semibold
                            transition

                            {{ request()->routeIs('admin.*')
                                ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30'
                                : 'text-gray-600 dark:text-gray-300 hover:bg-white/10'
                            }}
                            ">

                            Admin Panel

                        </a>

                    @endif

                </div>

            </div>

            <!-- ===================================== -->
            <!-- RIGHT -->
            <!-- ===================================== -->

            <div class="flex items-center gap-4">

                <!-- THEME -->
                <button
                    onclick="
                        if(document.documentElement.classList.contains('dark')){
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('theme', 'light');
                        } else {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('theme', 'dark');
                        }
                    "

                    class="w-12 h-12 rounded-2xl
                    bg-white dark:bg-[#1E293B]
                    border border-gray-200 dark:border-white/10
                    flex items-center justify-center
                    shadow-lg hover:scale-110 transition">

                    <span class="dark:hidden text-xl">
                        🌙
                    </span>

                    <span class="hidden dark:inline text-xl">
                        ☀️
                    </span>

                </button>

                <!-- ===================================== -->
                <!-- NOTIFICATION -->
                <!-- ===================================== -->

                @php

                    $notifications =
                        auth()->user()
                        ->notifications()
                        ->latest()
                        ->take(10)
                        ->get();

                    $unread =
                        auth()->user()
                        ->notifications()
                        ->where('is_read', false)
                        ->count();

                @endphp

                <div class="relative">

                    <!-- BUTTON -->
                    <button
                        @click="notifOpen = !notifOpen"

                        class="relative w-12 h-12 rounded-2xl
                        bg-white dark:bg-[#1E293B]
                        border border-gray-200 dark:border-white/10
                        flex items-center justify-center
                        shadow-lg hover:scale-110 transition">

                        🔔

                        @if($unread > 0)

                            <span
                                id="notifBadge"
                                class="absolute -top-1 -right-1
                                bg-red-500 text-white text-xs
                                min-w-[22px] h-[22px]
                                rounded-full
                                flex items-center justify-center
                                animate-pulse">

                                {{ $unread }}

                            </span>

                        @endif

                    </button>

                    <!-- DROPDOWN -->
                    <div
                        x-show="notifOpen"
                        @click.away="notifOpen = false"

                        x-transition

                        class="absolute right-0 mt-4 w-96
                        rounded-[30px]
                        overflow-hidden
                        bg-white dark:bg-[#111827]
                        border border-gray-200 dark:border-white/10
                        shadow-2xl z-50">

                        <!-- HEADER -->
                        <div
                            class="p-5 border-b border-gray-200 dark:border-white/10 flex items-center justify-between">

                            <h2
                                class="font-black text-lg text-gray-900 dark:text-white">

                                Notifications

                            </h2>

                            <button
                                onclick="markAllAsRead()"

                                class="px-4 py-2 rounded-xl
                                bg-blue-500 text-white text-xs font-semibold
                                hover:bg-blue-600 transition">

                                Read All

                            </button>

                        </div>

                        <!-- LIST -->
                        <div
                            id="notifList"
                            class="max-h-96 overflow-y-auto">

                            @forelse($notifications as $notification)

                                <div
                                    class="
                                    notif-item
                                    p-5
                                    border-b border-gray-100 dark:border-white/5
                                    hover:bg-gray-100 dark:hover:bg-white/5
                                    transition
                                    flex gap-4

                                    {{ !$notification->is_read
                                        ? 'bg-blue-500/10'
                                        : '' }}
                                    ">

                                    @if(!$notification->is_read)

                                        <div
                                            class="notif-dot w-3 h-3 rounded-full bg-red-500 mt-2 animate-pulse">
                                        </div>

                                    @endif

                                    <div class="flex-1">

                                        <h4
                                            class="font-semibold text-gray-900 dark:text-white">

                                            {{ $notification->message }}

                                        </h4>

                                        <p
                                            class="text-xs text-gray-500 mt-2">

                                            {{ $notification->created_at->diffForHumans() }}

                                        </p>

                                    </div>

                                </div>

                            @empty

                                <div
                                    class="p-10 text-center text-gray-400">

                                    No notifications

                                </div>

                            @endforelse

                        </div>

                    </div>

                </div>

                <!-- ===================================== -->
                <!-- PROFILE -->
                <!-- ===================================== -->

                <div class="relative">

                    <button
                        @click="profileOpen = !profileOpen"

                        class="flex items-center gap-3
                        px-3 py-2 rounded-2xl
                        bg-white dark:bg-[#1E293B]
                        border border-gray-200 dark:border-white/10
                        shadow-lg hover:scale-[1.02] transition">

                        <!-- AVATAR -->
                        @if(auth()->user()->avatar)

                            <img
                                src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                class="w-11 h-11 rounded-2xl object-cover border border-white/10">

                        @else

                            <div
                                class="w-11 h-11 rounded-2xl
                                bg-gradient-to-br from-blue-500 to-indigo-600
                                flex items-center justify-center
                                font-black text-white">

                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                            </div>

                        @endif

                        <!-- USER -->
                        <div
                            class="hidden md:block text-left">

                            <h4
                                class="text-sm font-black text-gray-900 dark:text-white leading-none">

                                {{ auth()->user()->name }}

                            </h4>

                            <p
                                class="text-xs text-gray-500 dark:text-gray-400 mt-1">

                                {{ auth()->user()->role }}

                            </p>

                        </div>

                        <!-- ARROW -->
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7" />

                        </svg>

                    </button>

                    <!-- DROPDOWN -->
                    <div
                        x-show="profileOpen"
                        @click.away="profileOpen = false"

                        x-transition

                        class="absolute right-0 mt-4 w-72
                        rounded-[30px]
                        overflow-hidden
                        bg-white dark:bg-[#111827]
                        border border-gray-200 dark:border-white/10
                        shadow-2xl z-50">

                        <!-- TOP -->
                        <div
                            class="p-6 border-b border-gray-200 dark:border-white/10">

                            <div
                                class="flex items-center gap-4">

                                @if(auth()->user()->avatar)

                                    <img
                                        src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                        class="w-16 h-16 rounded-3xl object-cover">

                                @else

                                    <div
                                        class="w-16 h-16 rounded-3xl
                                        bg-gradient-to-br from-blue-500 to-indigo-600
                                        flex items-center justify-center
                                        text-white text-2xl font-black">

                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                                    </div>

                                @endif

                                <div>

                                    <h3
                                        class="font-black text-gray-900 dark:text-white">

                                        {{ auth()->user()->name }}

                                    </h3>

                                    <p
                                        class="text-sm text-gray-500 dark:text-gray-400">

                                        {{ auth()->user()->email }}

                                    </p>

                                </div>

                            </div>

                        </div>

                        <!-- MENU -->
                        <div class="p-3">

                            <!-- PROFILE -->
                            <a
                                href="{{ route('profile') }}"

                                class="flex items-center gap-3
                                px-4 py-3 rounded-2xl
                                hover:bg-gray-100 dark:hover:bg-white/5
                                text-gray-700 dark:text-gray-300
                                transition">

                                👤 Profile

                            </a>

                            <!-- DASHBOARD -->
                            <a
                                href="{{ route('dashboard') }}"

                                class="flex items-center gap-3
                                px-4 py-3 rounded-2xl
                                hover:bg-gray-100 dark:hover:bg-white/5
                                text-gray-700 dark:text-gray-300
                                transition">

                                📊 Dashboard

                            </a>

                            <!-- LOGOUT -->
                            <button
                                wire:click="logout"

                                class="w-full text-left flex items-center gap-3
                                px-4 py-3 rounded-2xl
                                hover:bg-red-500/10
                                text-red-500 transition">

                                🚪 Logout

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</nav>

<!-- THEME -->
<script>

if (
    localStorage.theme === 'dark' ||
    (!('theme' in localStorage) &&
    window.matchMedia('(prefers-color-scheme: dark)').matches)
) {

    document.documentElement.classList.add('dark')

} else {

    document.documentElement.classList.remove('dark')

}

</script>

<!-- NOTIFICATION -->
<script>

function markAllAsRead(){

    fetch("{{ route('notifications.read') }}")
    .then(() => {

        const badge =
            document.getElementById('notifBadge');

        if(badge){

            badge.remove();

        }

        document.querySelectorAll('.notif-dot')
        .forEach(dot => dot.remove());

    });

}

</script>