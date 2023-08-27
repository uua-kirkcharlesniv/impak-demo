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
        @else
            <div class="max-w-2xl m-auto mt-16">
                <div class="text-center px-4">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-t from-slate-200 to-slate-100 mb-4">
                        🔘
                    </div>
                    <h2 class="text-2xl text-slate-800 font-bold mb-2">
                        Start viewing your results, and our insights.
                    </h2>
                    <div class="mb-6">
                        Gain immediate access to your survey's outcomes and our expert insights. Unveil patterns,
                        trends, and actionable takeaways with a simple view.
                    </div>

                    <select wire:model="selectedSurvey" class="form-select w-full">
                        <option value="">Select a survey</option>
                        @foreach ($surveys as $index => $mySurvey)
                            <option value="{{ $index }}">{{ $mySurvey->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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
