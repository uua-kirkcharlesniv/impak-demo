<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto" x-data="{ employeeModalOpen: false }">

        <!-- Welcome banner -->

        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Avatars -->
            {{-- <x-dashboard.dashboard-avatars /> --}}
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Dashboard ✨</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                <livewire:company-filter />

                <!-- Datepicker built with flatpickr -->
                {{-- <x-datepicker /> --}}

                <livewire:create-employee-button />

                <livewire:setup-stepper />

            </div>

        </div>

        <livewire:mood-dashboard />
    </div>


</x-app-layout>
