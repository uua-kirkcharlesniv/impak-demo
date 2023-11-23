<x-app-layout>
    <div class="flex flex-col px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto h-[calc(100vh-74px)] ">
        <!-- Page header -->
        <div class="flex justify-between items-center mb-5">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Mood Board ✨</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <livewire:company-filter />

                <!-- Datepicker built with flatpickr -->
                {{-- <x-datepicker /> --}}

                <!-- Add account button -->
                {{-- <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
            <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                <path
                    d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
            </svg>
            <span class="hidden xs:block ml-2">Add Mood Board Entry</span>
        </button> --}}

            </div>
        </div>

        <div class="flex-1">
            <livewire:mood-dashboard />
        </div>
    </div>


    </div>
</x-app-layout>
