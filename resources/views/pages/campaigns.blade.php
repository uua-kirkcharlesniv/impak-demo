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

        @if ($campaigns->count() < 1)
            <div class="max-w-2xl m-auto mt-16">
                <div class="text-center px-4">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-t from-slate-200 to-slate-100 mb-4">
                        👩🏻‍💻
                    </div>
                    <h2 class="text-2xl text-slate-800 font-bold mb-2">
                        Embark on insights, as your survey journey starts here.
                    </h2>
                    <div class="mb-6">
                        Begin your voyage into valuable insights with us. Explore a world of possibilities as you take
                        your first steps in the realm of surveys, where every question leads to discovery.

                    </div>

                    <livewire:create-survey-button />
                </div>
            </div>
        @endif

        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">

            <!-- Campaign cards -->
            @foreach ($campaigns as $campaign)
                <x-campaigns.campaigns-card :campaign="$campaign" />
            @endforeach

        </div>

        <!-- Pagination -->
        @if (isset($campaigns->links))
            <div class="mt-8">
                {{ $campaigns->links() }}
            </div>
        @endif

    </div>
</x-app-layout>
