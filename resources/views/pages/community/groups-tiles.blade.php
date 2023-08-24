<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">
                    @if (in_array(Request::segment(2), ['groups']))
                        Groups 👥
                    @else
                        Departments 💼
                    @endif
                </h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Search form -->
                {{-- <x-search-form /> --}}

                <!-- Add member button -->
                @if (in_array(Request::segment(2), ['groups']))
                    <livewire:create-community-button :isDepartment="false" />
                @else
                    <livewire:create-community-button :isDepartment="true" />
                @endif
            </div>

        </div>

        @if ($members->count() < 1)
            <div class="max-w-2xl m-auto mt-16">
                <div class="text-center px-4">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-t from-slate-200 to-slate-100 mb-4">
                        @if (in_array(Request::segment(2), ['groups']))
                            👥
                        @else
                            💼
                        @endif
                    </div>
                    <h2 class="text-2xl text-slate-800 font-bold mb-2">
                        @if (in_array(Request::segment(2), ['groups']))
                            Communicate better with your employees
                        @else
                            Create your departments for organizing your company
                        @endif
                    </h2>
                    <div class="mb-6">
                        @if (in_array(Request::segment(2), ['groups']))
                            Elevate your groups through the power of surveys, seamlessly translating insights into
                            actionable steps while nurturing meaningful connections that make a lasting impact.
                        @else
                            Streamline collaboration, enhance coordination, and pave the way for a harmoniously
                            structured company landscape.
                        @endif

                    </div>
                    @if (in_array(Request::segment(2), ['groups']))
                        <livewire:create-community-button :isDepartment="false" />
                    @else
                        <livewire:create-community-button :isDepartment="true" />
                    @endif
                </div>
            </div>
    </div>
    @endif

    <!-- Cards -->
    <div class="grid grid-cols-12 gap-6">


        <!-- Users cards -->
        @foreach ($members as $member)
            <x-community.groups-tiles-cards :member="$member" />
        @endforeach

    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $members->links() }}
    </div>

    </div>
</x-app-layout>
