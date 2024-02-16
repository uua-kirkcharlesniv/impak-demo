<div>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Survey Analytics ✨</h1>
                {{-- @if (isset($survey))
                <div class="w-80">
                    <h2 class="text-md text-slate-800 font-medium mb-1 mt-4">AI-Powered Analytics</h2>
                    <div class="relative inline-flex w-full" x-data="{ open: false, selected: 0 }">
                        <button class="btn w-full justify-between min-w-44 bg-white border-slate-200 hover:border-slate-300 text-slate-500 hover:text-slate-600" aria-label="Select date range" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
                            <span class="flex items-center">
                                <span x-text="$refs.options.children[selected].children[0].innerHTML"></span>
                            </span>
                            <svg class="shrink-0 ml-1 fill-current text-slate-400" width="11" height="7" viewBox="0 0 11 7">
                                <path d="M5.4 6.8L0 1.4 1.4 0l4 4 4-4 1.4 1.4z" />
                            </svg>
                        </button>
                        <div class="z-10 absolute top-full left-0 w-full bg-white border border-slate-200 py-1.5 rounded shadow-lg overflow-hidden mt-1" @click.outside="open = false" @keydown.escape.window="open = false" x-show="open" x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>
                            <div class="font-medium text-sm text-slate-600 divide-y divide-slate-200" x-ref="options">
                                <button tabindex="0" class="flex items-center justify-between w-full hover:bg-slate-50 py-2 px-3 cursor-pointer" :class="selected === 0 && 'text-indigo-500'" @click="selected = 0;open = false" @focus="open = true" @focusout="open = false">
                                    <span>Classic View</span>
                                    <svg class="shrink-0 ml-2 fill-current text-indigo-400" :class="selected !== 0 && 'invisible'" width="12" height="9" viewBox="0 0 12 9">
                                        <path d="M10.28.28L3.989 6.575 1.695 4.28A1 1 0 00.28 5.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28.28z" />
                                    </svg>
                                </button>
                                <button tabindex="0" class="flex items-center justify-between w-full hover:bg-slate-50 py-2 px-3 cursor-pointer" :class="selected === 1 && 'text-indigo-500'" @click="selected = 1;open = false" @focus="open = true" @focusout="open = false">
                                    <span>Questions View</span>
                                    <svg class="shrink-0 ml-2 fill-current text-indigo-400" :class="selected !== 1 && 'invisible'" width="12" height="9" viewBox="0 0 12 9">
                                        <path d="M10.28.28L3.989 6.575 1.695 4.28A1 1 0 00.28 5.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28.28z" />
                                    </svg>
                                </button>
                                <button tabindex="0" class="flex items-center justify-between w-full hover:bg-slate-50 py-2 px-3 cursor-pointer" :class="selected === 2 && 'text-indigo-500'" @click="selected = 2;open = false" @focus="open = true" @focusout="open = false">
                                    <span>Summary View</span>
                                    <svg class="shrink-0 ml-2 fill-current text-indigo-400" :class="selected !== 2 && 'invisible'" width="12" height="9" viewBox="0 0 12 9">
                                        <path d="M10.28.28L3.989 6.575 1.695 4.28A1 1 0 00.28 5.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28.28z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End -->
                </div>
                @endif --}}
            </div>
            @if (isset($survey))
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                <select wire:model="selectedSurvey" class="surveySelector form-select w-full">
                    <option value="">Select a survey</option>
                    @foreach ($surveys as $index => $mySurvey)
                    <option value="{{ $index }}">{{ $mySurvey->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>

        @if (isset($survey))
        <livewire:survey-individual-analytics :survey="$survey" wire:key="{{ $survey->id }}" />
        @else
        <div class="max-w-2xl m-auto mt-16">
            <div class="text-center px-4">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-t from-slate-200 to-slate-100 mb-4">
                    🔘
                </div>
                <h2 class="text-2xl text-slate-800 font-bold mb-2">
                    Start viewing your results, and our insights.
                </h2>
                <div class="mb-6">
                    Gain immediate access to your survey's outcomes and our expert insights. Unveil patterns,
                    trends, and actionable takeaways with a simple view.
                </div>

                <select wire:model="selectedSurvey" class="surveySelector form-select w-full">
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

@section('footer-scripts')
<script>
    window.onload = function() {
        // var selectElement = document.getElementById('surveySelector');
        var selectElement = document.querySelector('.surveySelector');
        var newIndex = @js($urlSurveyIndex);
        if (Number.isInteger(newIndex) && newIndex >= 0 && newIndex < selectElement.options.length) {
            selectElement.value = newIndex;
            selectElement.dispatchEvent(new Event('change'));
        }
    };

</script>
@endsection
