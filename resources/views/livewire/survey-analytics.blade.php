<div>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Survey Analytics ✨</h1>
            </div>

            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <select wire:model="selectedSurvey" class="form-select w-full">
                    <option value="">Select a survey</option>
                    @foreach ($surveys as $index => $mySurvey)
                        <option value="{{ $index }}">{{ $mySurvey->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

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
    </div>
</div>
