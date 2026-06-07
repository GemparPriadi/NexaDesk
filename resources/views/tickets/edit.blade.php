<x-app-layout>

<div class="min-h-screen bg-white dark:bg-[#0B1120] py-10">

    <div class="max-w-4xl mx-auto px-6">

        <!-- Header -->
        <div class="mb-8">

            <h1 class="text-4xl font-bold text-gray-900 dark:text-white">

                Edit Ticket

            </h1>

            <p class="text-gray-500 dark:text-gray-400 mt-2">

                Update your ticket information.

            </p>

        </div>

        <!-- Card -->
        <div
            class="bg-white dark:bg-[#111827] border border-gray-200 dark:border-gray-800 rounded-3xl shadow-xl p-8">

            <form
                action="{{ route('tickets.update', $ticket->id) }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6">

                @csrf
                @method('PUT')

                <!-- Title -->
                <div>

                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">

                        Ticket Title

                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ $ticket->title }}"
                        class="w-full rounded-xl bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3">

                </div>

                <!-- Category -->
                <div>

                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">

                        Category

                    </label>

                    <input
                        type="text"
                        name="category"
                        value="{{ $ticket->category }}"
                        class="w-full rounded-xl bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3">

                </div>

                <!-- Priority -->
                <div>

                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">

                        Priority

                    </label>

                    <select
                        name="priority"
                        class="w-full rounded-xl bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3">

                        <option value="Low"
                            {{ $ticket->priority == 'Low' ? 'selected' : '' }}>

                            Low

                        </option>

                        <option value="Medium"
                            {{ $ticket->priority == 'Medium' ? 'selected' : '' }}>

                            Medium

                        </option>

                        <option value="High"
                            {{ $ticket->priority == 'High' ? 'selected' : '' }}>

                            High

                        </option>

                        <option value="Urgent"
                            {{ $ticket->priority == 'Urgent' ? 'selected' : '' }}>

                            Urgent

                        </option>

                    </select>

                </div>

                </div>

                <!-- Description -->
                <div>

                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">

                        Description

                    </label>

                    <textarea
                        name="description"
                        rows="6"
                        class="w-full rounded-xl bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3">{{ $ticket->description }}</textarea>

                </div>

                <!-- Current Image -->
                @if($ticket->image)

                    <div>

                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">

                            Current Image

                        </label>

                        <img
                            src="{{ asset('storage/' . $ticket->image) }}"
                            class="w-48 h-48 object-cover rounded-2xl border border-gray-700 shadow-lg">

                    </div>

                @endif

                <!-- Upload New Image -->
                <div>

                    <label
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">

                        Replace Image (Optional)

                    </label>

                    <input
                        type="file"
                        name="image"
                        class="w-full rounded-xl bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3">

                    <p class="text-sm text-gray-500 mt-2">

                        Leave empty if you don't want to change the image.

                    </p>

                </div>

                <!-- Buttons -->
                <div class="pt-4 flex gap-4">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition">

                        Update Ticket

                    </button>

                    <a href="{{ route('tickets.index') }}"
                        class="bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white px-6 py-3 rounded-xl transition">

                        Cancel

                    </a>

                </div>

            </form>

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
