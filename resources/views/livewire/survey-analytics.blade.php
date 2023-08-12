<div>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Survey Analytics ✨</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <select wire:model="selectedSurvey" class="form-select w-full">
                    <option value="">Select a survey</option>
                    @foreach ($surveys as $index => $mySurvey)
                        <option value="{{ $index }}">{{ $mySurvey->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Cards -->


        @if (isset($survey))
            <livewire:survey-individual-analytics :survey="$survey" wire:key="{{ $survey->id }}" />
        @endif
        {{-- 
                <!-- Line chart (Analytics) -->
                <x-analytics.analytics-card-01 />

                <!--  Line chart (Active Users Right Now) -->
                <x-analytics.analytics-card-02 />

                <!-- Stacked bar chart (Acquisition Channels) -->
                <x-analytics.analytics-card-03 />

                <!-- Horizontal bar chart (Audience Overview) -->
                <x-analytics.analytics-card-04 />

                <!-- Report card (Top Channels) -->
                <x-analytics.analytics-card-05 />

                <!-- Report card (Top Pages) -->
                <x-analytics.analytics-card-06 />

                <!-- Report card (Top Countries) -->
                <x-analytics.analytics-card-07 />

                <!-- Doughnut chart (Sessions By Device) -->
                <x-analytics.analytics-card-08 />

                <!-- Doughnut chart (Visit By Age Category) -->
                <x-analytics.analytics-card-09 />

                <!-- Polar chart (Sessions By Gender) -->
                <x-analytics.analytics-card-10 />

                <!-- Table (Top Products) -->
                <x-analytics.analytics-card-11 /> --}}


    </div>


</div>
