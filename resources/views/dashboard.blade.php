<x-app-layout>

    <div class="min-h-screen bg-white dark:bg-[#0B1120] py-10">

        <div class="max-w-7xl mx-auto px-6">

            <!-- HERO -->
            <div
                class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-10 shadow-2xl mb-10 text-white">

                <h1 class="text-5xl font-bold mb-4">

                    Welcome Back, {{ auth()->user()->name }} 👋

                </h1>

                <p class="text-lg text-blue-100 mb-8">

                    Manage your IT support tickets easily with NexaDesk.

                </p>

                <div class="flex gap-4 flex-wrap">

                    <a href="{{ route('tickets.create') }}"
                        class="bg-white text-blue-600 px-6 py-3 rounded-2xl font-semibold hover:scale-105 transition">

                        + Create Ticket

                    </a>

                    <a href="{{ route('tickets.index') }}"
                        class="border border-white/30 px-6 py-3 rounded-2xl hover:bg-white/10 transition">

                        View My Tickets

                    </a>

                </div>

            </div>

            <!-- STATS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

                <!-- TOTAL TICKETS -->
                <div
                    class="bg-white dark:bg-[#111827] border border-gray-200 dark:border-gray-800 rounded-3xl p-8 shadow-xl">

                    <p class="text-gray-500 dark:text-gray-400">

                        My Total Tickets

                    </p>

                    <h2
                        class="text-5xl font-bold mt-4 text-gray-900 dark:text-white">

                        {{ $totalMyTickets }}

                    </h2>

                </div>

                <!-- ACCOUNT -->
                <div
                    class="bg-white dark:bg-[#111827] border border-gray-200 dark:border-gray-800 rounded-3xl p-8 shadow-xl">

                    <p class="text-gray-500 dark:text-gray-400">

                        Account Role

                    </p>

                    <h2
                        class="text-5xl font-bold mt-4 text-blue-500">

                        {{ auth()->user()->role }}

                    </h2>

                </div>

            </div>

            <!-- RECENT TICKETS -->
            <div
                class="bg-white dark:bg-[#111827] border border-gray-200 dark:border-gray-800 rounded-3xl shadow-2xl overflow-hidden">

                <!-- HEADER -->
                <div
                    class="p-6 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between">

                    <div>

                        <h2
                            class="text-3xl font-bold text-gray-900 dark:text-white">

                            Recent Tickets

                        </h2>

                        <p class="text-gray-500 dark:text-gray-400 mt-1">

                            Your latest support requests.

                        </p>

                    </div>

                    <a href="{{ route('tickets.index') }}"
                        class="text-blue-500 hover:text-blue-600 font-semibold">

                        View All →

                    </a>

                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead
                            class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">

                            <tr>

                                <th class="p-5 text-left">
                                    Title
                                </th>

                                <th class="p-5 text-left">
                                    Category
                                </th>

                                <th class="p-5 text-left">
                                    Priority
                                </th>

                                <th class="p-5 text-left">
                                    Status
                                </th>

                                <th class="p-5 text-left">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($recentTickets as $ticket)

                                <tr
                                    class="border-b border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-900 transition">

                                    <!-- TITLE -->
                                    <td
                                        class="p-5 font-semibold text-gray-900 dark:text-white">

                                        {{ $ticket->title }}

                                    </td>

                                    <!-- CATEGORY -->
                                    <td
                                        class="p-5 text-gray-700 dark:text-gray-300">

                                        {{ $ticket->category }}

                                    </td>

                                    <!-- PRIORITY -->
                                    <td class="p-5">

                                        @if($ticket->priority == 'Urgent')

                                            <span
                                                class="bg-red-500 text-white px-3 py-1 rounded-full text-sm">

                                                Urgent

                                            </span>

                                        @elseif($ticket->priority == 'High')

                                            <span
                                                class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm">

                                                High

                                            </span>

                                        @elseif($ticket->priority == 'Medium')

                                            <span
                                                class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm">

                                                Medium

                                            </span>

                                        @else

                                            <span
                                                class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">

                                                Low

                                            </span>

                                        @endif

                                    </td>

                                    <!-- STATUS -->
                                    <td class="p-5">

                                        @if($ticket->status == 'Pending')

                                            <span
                                                class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm">

                                                Pending

                                            </span>

                                        @elseif($ticket->status == 'Process')

                                            <span
                                                class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm">

                                                Process

                                            </span>

                                        @else

                                            <span
                                                class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">

                                                Done

                                            </span>

                                        @endif

                                    </td>

                                    <!-- ACTION -->
                                    <td class="p-5">

                                        <a href="{{ route('tickets.show', $ticket->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl transition">

                                            View

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5"
                                        class="text-center p-10 text-gray-500 dark:text-gray-400">

                                        No tickets yet.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <!-- FOOTER -->
    <footer
        class="mt-10 border-t border-gray-200 dark:border-white/10 py-8">

        <div
            class="flex flex-col items-center justify-center text-center gap-3">

            <!-- COPYRIGHT -->
            <p
                class="text-sm text-gray-500 dark:text-gray-400">

                © {{ date('Y') }} Ticketing System

            </p>

            <!-- PROJECT -->
            <p
                class="text-sm text-gray-500 dark:text-gray-500">

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
                class="inline-flex items-center gap-2 px-5 py-2 rounded-2xl bg-white dark:bg-[#1E293B] border border-gray-200 dark:border-white/10 shadow-lg hover:scale-105 transition duration-300">

                <!-- ICON -->
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

    </footer>

</x-app-layout>