<x-app-layout>

<div class="min-h-screen bg-white dark:bg-[#0B1120] py-10">

    <div class="max-w-7xl mx-auto px-6">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-8">

            <div>

                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">

                    Ticket Management

                </h1>

                <p class="text-gray-500 dark:text-gray-400 mt-2">

                    Manage and monitor all support tickets.

                </p>

            </div>

            <!-- CREATE BUTTON -->
            <a href="{{ route('tickets.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl shadow-lg shadow-blue-500/20 transition hover:scale-105">

                + Create Ticket

            </a>

        </div>

        <!-- SUCCESS ALERT -->
        @if(session('success'))

            <div
                class="mb-6 bg-green-500 text-white px-5 py-4 rounded-2xl shadow-lg">

                {{ session('success') }}

            </div>

        @endif

        <!-- ERROR ALERT -->
        @if(session('error'))

            <div
                class="mb-6 bg-red-500 text-white px-5 py-4 rounded-2xl shadow-lg">

                {{ session('error') }}

            </div>

        @endif

        <!-- SEARCH & FILTER -->
        <div
            class="bg-white dark:bg-[#111827] border border-gray-200 dark:border-gray-800 rounded-3xl p-6 mb-6 shadow-xl">

            <form
                method="GET"
                action="{{ route('tickets.index') }}"
                class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <!-- SEARCH -->
                <div>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search ticket..."
                        class="w-full rounded-2xl border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3">

                </div>

                <!-- STATUS -->
                <div>

                    <select
                        name="status"
                        class="w-full rounded-2xl border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3">

                        <option value="">
                            All Status
                        </option>

                        <option value="Pending"
                            {{ request('status') == 'Pending' ? 'selected' : '' }}>

                            Pending

                        </option>

                        <option value="Process"
                            {{ request('status') == 'Process' ? 'selected' : '' }}>

                            Process

                        </option>

                        <option value="Done"
                            {{ request('status') == 'Done' ? 'selected' : '' }}>

                            Done

                        </option>

                    </select>

                </div>

                <!-- PRIORITY -->
                <div>

                    <select
                        name="priority"
                        class="w-full rounded-2xl border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3">

                        <option value="">
                            All Priority
                        </option>

                        <option value="Low"
                            {{ request('priority') == 'Low' ? 'selected' : '' }}>

                            Low

                        </option>

                        <option value="Medium"
                            {{ request('priority') == 'Medium' ? 'selected' : '' }}>

                            Medium

                        </option>

                        <option value="High"
                            {{ request('priority') == 'High' ? 'selected' : '' }}>

                            High

                        </option>

                        <option value="Urgent"
                            {{ request('priority') == 'Urgent' ? 'selected' : '' }}>

                            Urgent

                        </option>

                    </select>

                </div>

                <!-- BUTTON -->
                <div class="flex gap-3">

                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-2xl transition">

                        Filter

                    </button>

                    <a href="{{ route('tickets.index') }}"
                        class="w-full bg-gray-500 hover:bg-gray-600 text-white px-4 py-3 rounded-2xl transition text-center">

                        Reset

                    </a>

                </div>

            </form>

        </div>

        <!-- TABLE CARD -->
        <div
            class="bg-white dark:bg-[#111827] border border-gray-200 dark:border-gray-800 rounded-3xl shadow-2xl overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <!-- TABLE HEAD -->
                    <thead
                        class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">

                        <tr>

                            <th class="p-5 text-left">
                                Image
                            </th>

                            <th class="p-5 text-left">
                                Title
                            </th>

                            <th class="p-5 text-left">
                                Submitted By
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

                    <!-- TABLE BODY -->
                    <tbody>

                        @forelse($tickets as $ticket)

                            <tr
                                class="border-b border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-900 transition">

                                <!-- IMAGE -->
                                <td class="p-5">

                                    @if($ticket->image)

                                        <img
                                            src="{{ asset('storage/' . $ticket->image) }}"
                                            class="w-16 h-16 rounded-2xl object-cover shadow-lg">

                                    @else

                                        <div
                                            class="w-16 h-16 rounded-2xl bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500">

                                            📄

                                        </div>

                                    @endif

                                </td>

                                <!-- TITLE -->
                                <td class="p-5">

                                    <div
                                        class="font-semibold text-gray-900 dark:text-white">

                                        {{ $ticket->title }}

                                    </div>

                                </td>

                                <!-- USER -->
                                <td class="p-5">

                                    <div class="flex flex-col">

                                        <span class="font-semibold text-gray-900 dark:text-white">

                                            {{ $ticket->user->name }}

                                        </span>

                                        <span class="text-xs text-gray-400">

                                            {{ $ticket->user->email }}

                                        </span>

                                    </div>

                                </td>

                                <!-- CATEGORY -->
                                <td class="p-5 text-gray-700 dark:text-gray-300">

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

                                    <div class="flex gap-2 flex-wrap">

                                        <!-- VIEW -->
                                        <a href="{{ route('tickets.show', $ticket->id) }}"
                                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl transition">

                                            View

                                        </a>

                                        {{-- USER / ADMIN EDIT --}}
                                        @if(
                                            auth()->user()->role === 'admin' ||
                                            $ticket->status == 'Pending'
                                        )

                                            <a href="{{ route('tickets.edit', $ticket->id) }}"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl transition">

                                                Edit

                                            </a>

                                        @endif

                                        {{-- ADMIN PROCESS --}}
                                        @if(
                                            auth()->user()->role === 'admin' &&
                                            $ticket->status == 'Pending'
                                        )

                                            <form
                                                action="{{ route('tickets.process', $ticket->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('PUT')

                                                <button
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl transition">

                                                    Process

                                                </button>

                                            </form>

                                        @endif

                                        {{-- ADMIN DONE --}}
                                        @if(
                                            auth()->user()->role === 'admin' &&
                                            $ticket->status == 'Process'
                                        )

                                            <form
                                                action="{{ route('tickets.done', $ticket->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('PUT')

                                                <button
                                                    class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-xl transition">

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

                                <td colspan="7"
                                    class="text-center p-10 text-gray-500 dark:text-gray-400">

                                    No tickets found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->
            <div class="p-6">

                {{ $tickets->links() }}

            </div>

        </div>

    </div>
</div>

@if(session('success_toast'))

<script>

    document.addEventListener('DOMContentLoaded', () => {

        successToast(
            @json(session('success_toast'))
        );

    });

</script>

@endif

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
