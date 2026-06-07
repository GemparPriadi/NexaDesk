<x-app-layout>

<div>

<div class="min-h-screen">

    <div class="max-w-7xl mx-auto px-6">

        <!-- HEADER -->
        <div
            class="bg-white dark:bg-[#111827] border border-gray-200 dark:border-gray-800 rounded-3xl p-8 shadow-xl mb-10">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                <div>

                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white">

                        Admin Dashboard

                    </h1>

                    <p class="text-gray-500 dark:text-gray-400 mt-2">

                        Manage all user tickets here.

                    </p>

                </div>

                <!-- EXPORT BUTTON -->
                <a href="{{ route('tickets.export.pdf') }}"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-2xl shadow-lg transition duration-300 hover:scale-105 flex items-center gap-2">

                    📄 Export PDF

                </a>

            </div>

        </div>

        <!-- SUCCESS -->
        @if(session('success'))

            <div
                class="bg-green-500 text-white p-4 rounded-2xl mb-6 shadow-lg">

                {{ session('success') }}

            </div>

        @endif

        <!-- STATS -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mb-10">

            <!-- USERS -->
            <div
                class="bg-gradient-to-br from-blue-500 to-blue-700 p-6 rounded-3xl text-white shadow-xl hover:-translate-y-1 transition duration-300">

                <h2 class="text-sm uppercase opacity-80">

                    👤 Total Users

                </h2>

                <p class="text-5xl font-bold mt-4">

                    {{ $totalUsers }}

                </p>

            </div>

            <!-- TICKETS -->
            <div
                class="bg-gradient-to-br from-purple-500 to-fuchsia-600 p-6 rounded-3xl text-white shadow-xl hover:-translate-y-1 transition duration-300">

                <h2 class="text-sm uppercase opacity-80">

                    🎫 Tickets

                </h2>

                <p class="text-5xl font-bold mt-4">

                    {{ $totalTickets }}

                </p>

            </div>

            <!-- PENDING -->
            <div
                class="bg-gradient-to-br from-yellow-400 to-yellow-600 p-6 rounded-3xl text-white shadow-xl hover:-translate-y-1 transition duration-300">

                <h2 class="text-sm uppercase opacity-80">

                    ⏳ Pending

                </h2>

                <p class="text-5xl font-bold mt-4">

                    {{ $pendingTickets }}

                </p>

            </div>

            <!-- PROCESS -->
            <div
                class="bg-gradient-to-br from-blue-600 to-indigo-700 p-6 rounded-3xl text-white shadow-xl hover:-translate-y-1 transition duration-300">

                <h2 class="text-sm uppercase opacity-80">

                    ⚙️ Process

                </h2>

                <p class="text-5xl font-bold mt-4">

                    {{ $processTickets }}

                </p>

            </div>

            <!-- DONE -->
            <div
                class="bg-gradient-to-br from-green-500 to-emerald-700 p-6 rounded-3xl text-white shadow-xl hover:-translate-y-1 transition duration-300">

                <h2 class="text-sm uppercase opacity-80">

                    ✅ Done

                </h2>

                <p class="text-5xl font-bold mt-4">

                    {{ $doneTickets }}

                </p>

            </div>

        </div>

        <!-- CHART SECTION -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-10">

            <!-- DONUT CHART -->
            <div
                class="bg-white dark:bg-[#111827] rounded-3xl p-6 shadow-xl border border-gray-200 dark:border-gray-800">

                <h2
                    class="text-xl font-bold text-gray-900 dark:text-white mb-6">

                    📊 Ticket Status

                </h2>

                <div class="relative h-[320px]">

                    <canvas
                        id="statusChart"

                        data-pending="{{ $pendingTickets }}"
                        data-process="{{ $processTickets }}"
                        data-done="{{ $doneTickets }}">

                    </canvas>

                </div>

            </div>

            <!-- BAR CHART -->
            <div
                class="xl:col-span-2 bg-white dark:bg-[#111827] rounded-3xl p-6 shadow-xl border border-gray-200 dark:border-gray-800">

                <h2
                    class="text-xl font-bold text-gray-900 dark:text-white mb-6">

                    📈 System Analytics

                </h2>

                <div class="relative h-[320px]">

                    <canvas
                        id="overviewChart"

                        data-users="{{ $totalUsers }}"
                        data-tickets="{{ $totalTickets }}">

                    </canvas>

                </div>

            </div>

        </div>

        <!-- TABLE -->
        <div
            class="bg-white dark:bg-[#111827] rounded-3xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-800 mb-10">

            <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                <h2
                    class="text-2xl font-bold text-gray-900 dark:text-white">

                    🧾 Recent Tickets

                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead
                        class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">

                        <tr>

                            <th class="p-5 text-left">
                                User
                            </th>

                            <th class="p-5 text-left">
                                Title
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
                                class="border-b border-gray-200 dark:border-gray-800 hover:bg-blue-500/5 transition">

                                <!-- USER -->
                                <td class="p-5">

                                    <div>

                                        <p
                                            class="font-bold text-gray-900 dark:text-white">

                                            {{ $ticket->user->name }}

                                        </p>

                                        <p
                                            class="text-sm text-gray-500">

                                            {{ $ticket->user->email }}

                                        </p>

                                    </div>

                                </td>

                                <!-- TITLE -->
                                <td
                                    class="p-5 text-gray-900 dark:text-white font-semibold">

                                    {{ $ticket->title }}

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

                                    <div class="flex gap-2 flex-wrap">

                                        <!-- PROCESS -->
                                        @if($ticket->status == 'Pending')

                                            <form
                                                action="{{ route('tickets.process', $ticket->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('PUT')

                                                <button
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl transition">

                                                    Process

                                                </button>

                                            </form>

                                        @endif

                                        <!-- DONE -->
                                        @if($ticket->status == 'Process')

                                            <form
                                                action="{{ route('tickets.done', $ticket->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('PUT')

                                                <button
                                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl transition">

                                                    Done

                                                </button>

                                            </form>

                                        @endif

                                        {{-- DELETE --}}
                                        @if($ticket->status == 'Done')

                                            <form
                                                id="delete-form-{{ $ticket->id }}"
                                                action="{{ route('tickets.destroy', $ticket->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="button"

                                                    onclick="deleteConfirm(() => {

                                                        document
                                                            .getElementById(
                                                                'delete-form-{{ $ticket->id }}'
                                                            )
                                                            .submit();

                                                        successToast(
                                                            'Ticket deleted successfully 🗑️'
                                                        );

                                                    })"

                                                    class="bg-red-500 hover:bg-red-600
                                                    text-white px-4 py-2 rounded-xl
                                                    transition duration-300
                                                    hover:scale-105 shadow-lg">

                                                    Delete

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center p-10 text-gray-500">

                                    No tickets found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- ACTIVITY LOG -->
        <div
            class="bg-white dark:bg-[#111827] rounded-3xl shadow-xl border border-gray-200 dark:border-gray-800">

            <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                <h2
                    class="text-2xl font-bold text-gray-900 dark:text-white">

                    🔥 Activity Logs

                </h2>

            </div>

            <div class="divide-y divide-gray-200 dark:divide-gray-800">

                @forelse($activityLogs as $log)

                    <div
                        class="p-5 flex items-start justify-between hover:bg-gray-50 dark:hover:bg-gray-900 transition">

                        <div>

                            <p
                                class="font-semibold text-gray-900 dark:text-white">

                                {{ $log->action }}

                            </p>

                            <p
                                class="text-sm text-gray-500 dark:text-gray-400 mt-1">

                                {{ $log->description }}

                            </p>

                        </div>

                        <div
                            class="text-xs text-gray-400">

                            {{ $log->created_at->diffForHumans() }}

                        </div>

                    </div>

                @empty

                    <div
                        class="p-10 text-center text-gray-500">

                        No activity logs

                    </div>

                @endforelse

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

</div>

<script>

document.addEventListener('DOMContentLoaded', () => {

    setTimeout(() => {

        if(window.initAdminCharts){

            window.initAdminCharts();

        }

    }, 200);

});

window.addEventListener('pageshow', () => {

    setTimeout(() => {

        if(window.initAdminCharts){

            window.initAdminCharts();

        }

    }, 200);

});

</script>
</x-app-layout>