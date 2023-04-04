<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">
                    @if (in_array(Request::segment(1), ['employee']))
                        Impak Company ✨
                    @else
                        @if (in_array(Request::segment(2), ['groups']))
                            Acme Group ✨
                        @else
                            XYZ Department ✨
                        @endif
                    @endif
                </h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Search form -->
                <x-search-form />

                <!-- Add member button -->
                @if (in_array(Request::segment(1), ['employee']))
                    <livewire:create-employee-button />
                @else
                    <livewire:add-employee-to-community-button />
                @endif
            </div>

        </div>

        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">

            <!-- Users cards -->
            @foreach ($members as $member)
                <x-community.users-tabs-cards :member="$member" :index="$loop->index" />
            @endforeach

        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $members->links() }}
        </div>

    </div>
</x-app-layout>
