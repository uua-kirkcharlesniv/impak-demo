<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        
        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Surveys ✨</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Search form -->
                <x-search-form />

                <!-- Filter button -->
                <x-dropdown-filter align="right" />

                <!-- Create campaign button -->
                <livewire:create-survey-button />
               
            </div>

        </div>

        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">

            <!-- Campaign cards -->
            @foreach($campaigns as $campaign)
                <x-campaigns.campaigns-card :campaign="$campaign" />
            @endforeach

        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{$campaigns->links()}}
        </div>

    </div>
</x-app-layout>
