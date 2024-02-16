<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto" x-data="{ inviteModalOpen: true }"">

        <!-- Page header -->
        <div class=" sm:flex sm:justify-between sm:items-center mb-8">

        <!-- Left: Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">
                Invited Members
            </h1>
        </div>

        <!-- Right: Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
            <livewire:invite-employee />
        </div>

    </div>

    <!-- Cards -->
    <div class="grid grid-cols-12 gap-6">

        <!-- Users cards -->
        @foreach ($invited as $member)
        <x-invited-tabs-cards :member="$member" :index="$loop->index" />
        @endforeach

    </div>


    </div>
</x-app-layout>
