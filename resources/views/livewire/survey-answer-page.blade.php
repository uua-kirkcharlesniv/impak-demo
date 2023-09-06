<div class="h-full mx-24 my-8" id="confetti">
    <div class="font-medium mb-4">
        <span
            class="font-bold text-indigo-600">{{ ucwords(strtolower(str_replace('_', ' ', $survey->survey_type))) }}</span>
        / {{ $survey->name }}
    </div>
    <div class="bg-white w-full p-6 rounded-md shadow-md">
        <div class="flex justify-end items-center	">
            <div style="margin-right: auto">
                <span class="text-indigo-600 font-semibold">
                    {{ $this->answeredQuestionsCount + 1 }}
                </span>
                <span class="font-medium">
                    of {{ array_sum($this->totalQuestions) }}
                </span>
            </div>
            <h1>
                <div x-data="{ remainingTime: '{{ $this->calculateRemainingTime() }}' }" x-init="() => {
                    const endTime = new Date({{ $endTime->timestamp }} * 1000);
                
                    const updateRemainingTime = () => {
                        const now = new Date();
                        const secondsRemaining = Math.max(0, Math.floor((endTime - now) / 1000));
                        const minutes = Math.floor(secondsRemaining / 60);
                        const seconds = secondsRemaining % 60;
                        remainingTime = (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
                
                        if (secondsRemaining <= 0) {
                            clearInterval(timerInterval);
                            Livewire.emit('timerExpired');
                        }
                    };
                
                    updateRemainingTime();
                    const timerInterval = setInterval(updateRemainingTime, 1000);
                }"
                    x-on:start-timer.window="remainingTime = '{{ $this->calculateRemainingTime() }}'">

                    <div class="px-2 py-1 border border-slate-300 rounded-full text-sm  font-semibold">
                        <p>
                            <i class="fa-solid fa-stopwatch text-indigo-500 mr-0.5"></i>

                            <span x-show="remainingTime !== '00:00'" x-text="remainingTime"></span>
                            <span x-show="remainingTime == '00:00'">Time Limit Reached</span>
                        </p>
                    </div>
                </div>
            </h1>
            <h1 class="ml-2 px-2 py-1 bg-indigo-400 text-white rounded-full text-sm">
                {{ $points }} pts
            </h1>
        </div>

        <div class="bg-gray-200 rounded-full h-4 mt-4 mb-6">
            <div class="h-4 bg-blue-600 rounded-full" style="width: {{ $isAtEnd ? 100 : $this->progressPercentage }}%">
            </div>
        </div>
        <h1 class="font-black text-black text-xl mb-2">{{ $survey->name }}</h1>
        <p class="text-sm">{{ $survey->rationale_description }}</p>
    </div>
    @if ($isAtStart)
        <div class="max-w-md mx-auto my-12">

            <h1 class="text-3xl text-slate-800 font-bold">Reminders ✨</h1>
            <p class="text-sm text-slate-400 mb-6">Quick reminders before we start.</p>
            <!-- Form -->
            <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                <li class="flex items-center mb-2">
                    <svg class="w-4 h-4 mr-5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Please answer all questions honestly and to the best of your knowledge.
                </li>
                <li class="flex items-center mb-2">
                    <svg class="w-4 h-4 mr-5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Your responses will be kept confidential and anonymous.
                </li>
                <li class="flex items-center mb-2">
                    <svg class="w-4 h-4 mr-5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Please ensure that you are in a quiet and distraction-free environment before beginning the survey.
                </li>
                <li class="flex items-center mb-2">
                    <svg class="w-4 h-4 mr-5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Please read each question carefully before answering.
                </li>
                <li class="flex items-center mb-6">
                    <svg class="w-4 h-4 mr-5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    You must not exceed 5 minutes answering <br> this survey.
                </li>
                <div class="mt-12 flex items-center justify-between" x-data="{ bgClass: 'bg-gray-500 hover:bg-gray-600' }" x-init="setTimeout(() => bgClass = 'bg-indigo-500 hover:bg-indigo-600', 5000)">
                    <a :class="bgClass + ' btn text-white ml-auto'" wire:click="processStart">Let's go!</a>
                </div>
            </ul>

        </div>
    @elseif($isAtEnd)
        <div class="flex flex-col items-center justify-center my-12" x-init="setTimeout(() => showConfetti(), 500)">
            <div class="max-w-md mx-auto text-center">
                <div class="flex items-center justify-center mb-6">
                    <img src="https://static.vecteezy.com/system/resources/previews/017/177/933/original/round-check-mark-symbol-with-transparent-background-free-png.png"
                        alt="" class="h-1/2 w-1/2">
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Survey Submitted - Thank You!</h1>
                <p class="text-lg text-gray-600 mb-8">We appreciate you taking the time to share your thoughts with us.
                    Your feedback will help us improve our services and better serve you in the future.</p>
                <a href="{{ route('survey.past') }}"
                    class="inline-block px-6 py-3 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg font-semibold transition duration-200">Continue</a>
            </div>
        </div>
    @else
        <div class="mt-4">
            <span class="mb-4 text-lg font-semibold">{{ $this->currentSectionData->name }}</span>
            <div class="bg-white rounded-sm shadow-md mt-4">
                <div class="p-4">
                    <span class="text-black mt-4 text-lg font-semibold">
                        {{ $this->question->content }}
                        @if ($this->question->is_required)
                            <span class="text-red-800"><b>*</b></span>
                        @endif
                    </span>


                    <div wire:key="{{ $this->question->id }}" class="mt-4">
                        @switch($this->question->type)
                            @case('likert')
                                <div class="flex items-center justify-around w-full">
                                    @foreach (generateLikertNames($this->question->likert_type, $this->question->likert_order) as $index => $option)
                                        <label
                                            class="relative block flex flex-col items-center hover:border hover:shadow-lg rounded border-indigo-700 p-6">
                                            <input type="radio" name="{{ $this->question->key }}" wire:model="answer"
                                                value="{{ $option }}"
                                                id="{{ $this->question->key . '-' . Str::slug($option) }}"
                                                {{ ($value ?? old($this->question->key)) == $option ? 'checked' : '' }}
                                                class="peer sr-only">

                                            {!! fetchLikertFace($this->question->likert_type, $index, $this->question->likert_order) !!}

                                            <span class="text-lg font-bold">{{ $option }}</span>
                                            <div class="absolute inset-0 border-2 border-transparent peer-checked:border-indigo-400 rounded pointer-events-none"
                                                aria-hidden="true"></div>
                                        </label>
                                    @endforeach
                                </div>
                            @break;
                            @case('long-answer')
                            @case('short-answer')
                                <textarea name="{{ $this->question->key }}" maxlength="{{ $this->question->max }}" id="{{ $this->question->key }}"
                                    wire:model="answer" class="form-input w-full" {{ $disabled ?? false ? 'disabled' : '' }}>{{ $value ?? old($this->question->key) }}</textarea>
                                @if (isset($this->question->min))
                                    <span class="text-sm text-gray-400">Minimum of {{ $this->question->min }} characters.
                                    </span>
                                @endif
                                @if (isset($this->question->max))
                                    <span class="text-sm text-gray-400">Maximum of {{ $this->question->max }} characters.
                                    </span>
                                @endif
                            @break;
                            @case('radio')
                                @foreach ($this->question->options as $option)
                                    <div class="mb-2">
                                        <label class="relative block cursor-pointer">
                                            <input type="radio" name="{{ $this->question->key }}" wire:model="answer"
                                                id="{{ $this->question->key . '-' . Str::slug($option) }}"
                                                value="{{ $option }}" class="peer sr-only"
                                                {{ ($value ?? old($this->question->key)) == $option ? 'checked' : '' }}
                                                {{ $disabled ?? false ? 'disabled' : '' }} />
                                            <div
                                                class="flex items-center bg-white text-sm font-medium text-slate-800 p-4 rounded border border-slate-200 hover:border-slate-300 shadow-sm duration-150 ease-in-out">
                                                <span>{{ $option }}</span>
                                            </div>
                                            <div class="absolute inset-0 border-2 border-transparent peer-checked:border-indigo-400 rounded pointer-events-none"
                                                aria-hidden="true"></div>
                                        </label>

                                        @if (Auth::user()->hasPermissionTo('manage-employees'))
                                            <label class="custom-control-label"
                                                for="{{ $this->question->key . '-' . Str::slug($option) }}">
                                                @if ($includeResults ?? false)
                                                    <span class="text-success">
                                                        ({{ number_format((new \MattDaneshvar\Survey\Utilities\Summary($this->question))->similarAnswersRatio($option) * 100, 2) }}%)
                                                    </span>
                                                @endif
                                            </label>
                                        @endif
                                    </div>
                                @endforeach
                            @break;
                            @case('multiselect')
                                <div id="checkboxgroup-{{ $this->question->key }}" data-limit="{{ $this->question->max }}">
                                    @foreach ($this->question->options as $option)
                                        <div class="mb-2">
                                            <label class="relative block cursor-pointer">
                                                <input type="checkbox" name="{{ $this->question->key }}[]"
                                                    id="{{ $this->question->key . '-' . Str::slug($option) }}"
                                                    value="{{ $option }}" class="peer sr-only" wire:model="answer"
                                                    {{ count($this->answer) >= $this->question->max && !in_array($option, $this->answer) ?? false ? 'disabled' : '' }} />
                                                <div
                                                    class="flex items-center bg-white text-sm font-medium text-slate-800 p-4 rounded border border-slate-200 hover:border-slate-300 shadow-sm duration-150 ease-in-out">
                                                    <span>{{ $option }}</span>
                                                </div>
                                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-indigo-400 rounded pointer-events-none"
                                                    aria-hidden="true"></div>
                                            </label>
                                        </div>
                                    @endforeach

                                    @if (isset($this->question->min))
                                        <span class="text-sm text-gray-400">Minimum of {{ $this->question->min }} choices.
                                        </span>
                                    @endif
                                    @if (isset($this->question->max))
                                        <span class="text-sm text-gray-400">Maximum of {{ $this->question->max }} choices.
                                        </span>
                                    @endif
                                </div>
                            @break;
                            @case('range')
                                <input type="range" min="1" max="10" step="1"
                                    name="{{ $this->question->key }}" wire:model="answer" id="{{ $this->question->key }}"
                                    class="w-full" list="markers">
                                <datalist id="markers">
                                    <option value="1"></option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                    <option value="4"></option>
                                    <option value="5"></option>
                                    <option value="6"></option>
                                    <option value="7"></option>
                                    <option value="8"></option>
                                    <option value="9"></option>
                                    <option value="10"></option>
                                </datalist>
                            @break;
                        @endswitch

                        @if ($errors->has($this->question->key))
                            <div class="text-red-500 mt-3">{{ $errors->first($this->question->key) }}</div>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="p-4 clearfix">
                    @php
                        $isFinishing = $this->answeredQuestionsCount + 1 >= array_sum($this->totalQuestions);
                    @endphp
                    <button
                        class="{{ $isFinishing ? 'bg-green-500' : 'bg-indigo-500' }} text-white px-6 py-3 rounded-full text-xs"
                        wire:click="nextQuestion()" style="float: right">
                        @if ($isFinishing)
                            Complete
                        @else
                            Next question
                        @endif
                    </button>
                </div>
            </div>
        </div>
    @endif


    <script>
        function showConfetti() {
            party.confetti(document.getElementById("confetti"), {
                count: 50,
            });
        }
    </script>
</div>
