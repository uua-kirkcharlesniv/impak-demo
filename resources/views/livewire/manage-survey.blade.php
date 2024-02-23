@php
$index = 1;
@endphp
<div class="overflow-hidden" x-data="{ modalOpen: false }">
    <div class="h-[calc(100vh-74px)] flex">
        <!-- Fixed sidebar -->
        <div class="w-1/3 bg-white overflow-y-auto mr-2">
            <x-survey-tab isFirst="true" title="{{ $index }}. setup" icon="fa-screwdriver-wrench">
                <div>
                    <label class="block text-sm font-medium mb-1" for="name">Your survey name</label>
                    <input id="name" class="form-input w-full" type="text" placeholder="" wire:model.lazy="survey.name" wire:change="onSurveyNameChanged($event.target.value)" />
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1" for="countAllowedSubmissions">Maximum number of
                        submissions per respondent</label>
                    <input id="countAllowedSubmissions" class="form-input w-full" type="number" min="0" max="999" wire:model.lazy="survey.settings.limit-per-participant" wire:change="onMaxSubmissionsChanged($event.target.value)" placeholder="Leave blank to set to 1" />
                </div>
            </x-survey-tab>
            @if ($survey->framework_id == null)
            @php
            $index += 1;
            @endphp
            <x-survey-tab title="{{ $index }}. rationale" icon="fa-brain">
                <div>
                    <label class="block text-sm font-medium mb-1" for="rationale_title">Title</label>
                    <input id="rationale_title" class="form-input w-full" type="text" placeholder="" wire:model.lazy="survey.rationale" wire:change="onRationaleChanged($event.target.value)" />
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1" for="rationale_description">Description</label>
                    <textarea id="rationale_description" class="form-input w-full" type="text" placeholder="" wire:model.lazy="survey.rationale_description" wire:change="onRationaleDescriptionChanged($event.target.value)"></textarea>
                </div>

                <div x-data="{ option: '{{ $survey->survey_type }}' }">
                    <label class="block text-sm font-medium mb-1" for="survey_type">Survey Type</label>
                    <select class="form-select w-full" x-model="option" id="survey_type" name="survey_type" wire:model="survey.survey_type" wire:change="onSurveyTypeChanged($event.target.value)">
                        <option value="post_event" {{ $survey->survey_type == 'post_event' ? 'selected' : '' }}>Post
                            Event
                            Survey</option>
                        <option value="mental_health" {{ $survey->survey_type == 'mental_health' ? 'selected' : '' }}>
                            Mental Wellness
                        </option>
                        <option value="post_workshop" {{ $survey->survey_type == 'post_workshop' ? 'selected' : '' }}>
                            Post
                            Workshop
                            Survey</option>
                        <option value="needs_analysis" {{ $survey->survey_type == 'needs_analysis' ? 'selected' : '' }}>
                            Needs
                            Analysis Survey</option>
                        <option value="employee_engagement" selected="{{ $survey->survey_type == 'employee_engagement' }}">Employee Engagement
                            Survey
                        </option>
                        <option value="market_research" selected="{{ $survey->survey_type == 'market_research' }}">
                            Market Research Survey</option>
                        <option value="opinion_poll" selected="{{ $survey->survey_type == 'opinion_poll' }}">Opinion
                            Poll</option>
                        <option value="demographic" selected="{{ $survey->survey_type == 'demographic' }}">
                            Demographic
                            Survey</option>
                        <option value="product_feedback" selected="{{ $survey->survey_type == 'product_feedback' }}">
                            Product Feedback Survey</option>
                        <option value="event_evaluation" selected="{{ $survey->survey_type == 'event_evaluation' }}">
                            Event Evaluation Survey</option>
                        <option value="website_feedback" selected="{{ $survey->survey_type == 'website_feedback' }}">
                            Website Feedback Survey</option>
                        <option value="training_needs" selected="{{ $survey->survey_type == 'training_needs' }}">
                            Training Needs Assessment</option>
                        <option value="post_purchase" selected="{{ $survey->survey_type == 'post_purchase' }}">Post
                            Purchase Survey</option>
                        <option value="others" selected="{{ $survey->survey_type == 'others' }}">Others</option>
                    </select>

                    <div x-show="option == 'others'">
                        <input id="manual_survey_type" class="form-input w-full my-2" type="text" placeholder="Training Needs Survey" wire:model.lazy="survey.manual_survey_type" wire:change="onManualSurveyTypeChanged($event.target.value)" />
                        <label class="block text-sm font-medium mb-1" for="manual_sections">Section names</label>
                        <input id="manual_sections" class="form-input w-full" type="text" wire:model.lazy="survey.manual_sections" wire:change="onManualSectionsChanged($event.target.value)" placeholder="Employee Demographics, Knowledge and Skills Capacity, ..." />
                        <p id="helper-text-explanation" class="text-sm text-gray-500">Delimited by comma.</p>
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm font-medium mb-1" for="sub_specialization">Sub-specialization /
                            Target Focus</label>
                        <input id="sub_specialization" wire:model.lazy="survey.target_focus" wire:change="onTargetFocusChanged($event.target.value)" class="form-input w-full" type="text" placeholder="This is optional, but would help our AI to analyze more." wire:model.lazy="sub_specialization" />
                    </div>

                    <div class="container mt-4 mx-0 w-full flex flex-col items-center">
                        <button class="w-full bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-black py-2 px-4 border border-blue rounded" wire:click="analyzeSurvey" aria-controls="feedback-modal">

                            <span class="hidden xs:block ml-2">
                                Analyze & Generate
                            </span>
                        </button>
                    </div>
                </div>
            </x-survey-tab>
            @endif
            @php
            $index += 1;
            @endphp
            <x-survey-tab title="{{ $index }}. respondents" icon="fa-users">
                <livewire:survey-manager.respondent.user :survey="$survey" />
            </x-survey-tab>
            @php
            $index += 1;
            @endphp
            <x-survey-tab title="{{ $index }}. schedule" icon="fa-calendar-days">
                <livewire:form-schedule-component :survey="$survey" />
            </x-survey-tab>
            @php
            $index += 1;
            @endphp
            <x-survey-tab title="{{ $index }}. form" icon="fa-clipboard-question">
                @if ($survey->framework_id == null)
                <button class="w-full mb-4 bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-black py-2 px-4 border border-blue rounded" wire:click="addSection">
                    <span class="hidden xs:block ml-2">
                        Add Section
                    </span>
                </button>
                @endif
                <div class="sortable section-list scoreboard bg-white overflow-hidden w-full mx-auto transition-colors ">
                    @foreach ($survey->sections as $index => $section)
                    <div class="w-full mx-auto transition-colors border section-group [&:not(:last-child)]:border-b-0" wire:key="section-{{ $section->id }}" data-section-id="{{ $section->id }}">
                        <div class="flex items-center space-x-1 group py-2 pr-4 relative">
                            @if ($survey->framework_id == null)
                            <div class="cursor-move draggable p-2 -mr-2">
                                <i class="fa-solid fa-grip-lines h-4 w-4 text-gray-400"></i>
                            </div>
                            @endif

                            <div class="flex flex-col flex-grow truncate" x-data="{
                                    isEditing: false,
                                    focus: function() {
                                        const textInput = this.$refs.textInput;
                                        textInput.focus();
                                        textInput.select();
                                    }
                                }" x-cloak>
                                <div tabindex="0" class="relative max-w-full flex items-center hover:bg-gray-100 rounded px-2 cursor-pointer" style="height: auto;" x-on:click="isEditing = true">
                                    <div x-show=!isEditing>
                                        <div class="cursor-pointer max-w-full truncate w-full">
                                            {{ $section->name }}
                                        </div>
                                    </div>
                                    <div x-show=isEditing class="flex flex-col">
                                        <input type="text" class="form-input w-full px-2 border border-gray-400 text-lg shadow-inner" x-ref="textInput" wire:model.lazy="survey.sections.{{ $index }}.name" wire:change="onSectionNameChanged({{ $section->id }}, $event.target.value)" x-on:keydown.enter="isEditing = false" x-on:blur="isEditing = false" />
                                    </div>
                                </div>
                            </div>

                            @if(!($survey->publish_status == 'closed' || $survey->publish_status == 'published'))
                            <button @click.prevent="modalOpen = true" wire:click="toggleSectionSelection({{ $section->id }})" class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2">
                                <i class="fa-regular fa-add w-4 h-4 fill-current text-indigo-600"></i>
                            </button>

                            <button wire:click="deleteSection('{{ $section->id }}')" class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2">
                                <i class="fa-regular fa-trash-can w-4 h-4 fill-current text-red-600"></i>
                            </button>
                            @endif
                        </div>
                        <div class="group__goals sortable ml-10" data-section-id="{{ $section->id }}">
                            @foreach ($section->questions as $questionIndex => $question)
                            <div data-question-id="{{ $question->id }}" class="group__goals__item flex items-center space-x-1 group py-2 pr-4 relative w-full mx-auto transition-colors border-t">
                                @if ($survey->framework_id == null)
                                <div class="cursor-move draggable p-2 -mr-2">
                                    <i class="fa-solid fa-grip-lines h-4 w-4 text-gray-400"></i>
                                </div>
                                @endif

                                <div class="flex flex-col flex-grow truncate" x-data="{
                                            isEditing: false,
                                            focus: function() {
                                                const textInput = this.$refs.textInput;
                                                textInput.focus();
                                                textInput.select();
                                            }
                                        }" x-cloak>
                                    <div tabindex="0" class="relative max-w-full flex items-center hover:bg-gray-100 rounded px-2 cursor-pointer" style="height: auto;" x-on:click="isEditing = true">
                                        <div x-show=!isEditing>
                                            <div class="cursor-pointer max-w-full truncate w-full">
                                                {{ $question->content }}

                                            </div>
                                            <span class="text-xs text-gray-600" id="passwordHelp">{{ $question->formatted_type }}</span>
                                        </div>
                                        <div x-show=isEditing class="flex flex-col">
                                            <input type="text" class="form-input w-full px-2 border border-gray-400 text-lg shadow-inner" x-ref="textInput" wire:model.lazy="survey.sections.{{ $index }}.questions.{{ $questionIndex }}.content" wire:change="onQuestionNameChange({{ $question->id }}, $event.target.value)" x-on:keydown.enter="isEditing = false" x-on:blur="isEditing = false" />
                                        </div>
                                    </div>
                                </div>
                                @if(!($survey->publish_status == 'closed' || $survey->publish_status == 'published'))
                                <button wire:click="editQuestion({{ $question->id }})" class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2">
                                    <i class="fa-regular fa-gear w-4 h-4 fill-current text-blue-600"></i>
                                </button>

                                <button wire:click="deleteQuestion('{{ $question->id }}')" class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2">
                                    <i class="fa-regular fa-trash-can w-4 h-4 fill-current text-red-600"></i>
                                </button>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </x-survey-tab>
            {{-- <x-survey-tab title="customization" icon="fa-bars">

                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1" for="normal">Logo</label>
                    <header
                        class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                        <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                            <span>Drag and drop your</span>&nbsp;<span>files anywhere or</span>
                        </p>
                        <input id="hidden-input" type="file" multiple class="hidden" />
                        <button id="button"
                            class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                            Upload a file
                        </button>
                        <br>
                        <span class="text-gray-500 text-sm">Maximum size of 3MB</span>
                        <span class="text-gray-500 text-sm">Accepted files are only: .xlsx, .xls, .csv</span>
                    </header>
                </div>
                <div class="mt-4">

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer" checked>
                        <div
                            class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Enable Impak Branding</span>
                    </label>
                </div>
                <div class="mt-4" x-data="{ primary: '#386A20', accent: '#55624C' }">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1" for="normal">Primary Color</label>
                            <div class="flex justify-center space-x-2">
                                <input id="nativeColorPicker1" type="color" x-model="primary" />
                                <button id="burronNativeColor" type="button"
                                    x-bind:style="'background-color: ' + primary"
                                    class="inline-block rounded bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg">

                                    Primary
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1" for="normal">Accent Color</label>
                            <div class="flex justify-center space-x-2">
                                <input id="nativeColorPicker1" type="color" x-model="accent" />
                                <button id="burronNativeColor" type="button"
                                    x-bind:style="'background-color: ' + accent"
                                    class="inline-block rounded bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg">

                                    Accent
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4" x-data="{ color: '#6366f1' }">
                    <label class="block text-sm font-medium mb-1" for="normal">Submit Color</label>
                    <div class="flex space-x-2">
                        <input id="nativeColorPicker1" type="color" x-model="color" />
                        <button id="burronNativeColor" type="button" x-bind:style="'background-color: ' + color"
                            class="inline-block rounded bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg">

                            Submit
                        </button>
                    </div>
                </div>
            </x-survey-tab> --}}
            {{-- </x-survey-tab> --}}

            @if ($survey->publish_status == 'draft')
            <div class="p-4 border-b sticky top-0 z-10 bg-white">
                <button wire:click="updateStatus('published')" class="w-full py-2 px-4
                bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200
                text-white transition ease-in duration-200 text-center text-base font-medium focus:outline-none focus:ring-2
                focus:ring-offset-2 rounded-lg flex items-center hover:no-underline">
                    <span class="no-underline mx-auto"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white inline mr-1 -mt-1">
                            <path d="M17 21V13H7V21M7 3V8H15M19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16L21 8V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg> Publish </span>
                    <!---->
                </button>
                <p class="text-xs text-center text-slate-500 mt-4">By clicking this, your respondents will be able to view and answer your survey. This will also disable editing the questions. </p>
            </div>
            @elseif($survey->publish_status == 'published')
            <div class="p-4 sticky top-0 z-10 bg-white">
                <button wire:click="updateStatus('closed')" class="w-full py-2 px-4
                        bg-green-600 hover:bg-green-700 focus:ring-green-500 focus:ring-offset-green-200
                        text-white transition ease-in duration-200 text-center text-base font-medium focus:outline-none focus:ring-2
            focus:ring-offset-2 rounded-lg flex items-center hover:no-underline">
                    <span class="no-underline mx-auto"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white inline mr-1 -mt-1">
                            <path d="M17 21V13H7V21M7 3V8H15M19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16L21 8V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg> Mark as Completed </span>
                    <!---->
                </button>
                <p class="text-xs text-center text-slate-500 mt-4">Marking your survey as completed will mark it as completed, and will start generating AI results.</p>
            </div>
            @endif

            @if($survey->publish_status == 'published' || $survey->publish_status == 'closed')
            <div class="p-4 border-b sticky top-0 z-10 bg-white">
                <a href="{{ route('analytics', ['survey_id' => $survey->id]) }}" class="w-full py-2 px-4
                        bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200
                        text-white transition ease-in duration-200 text-center text-base font-medium focus:outline-none focus:ring-2
            focus:ring-offset-2 rounded-lg flex items-center hover:no-underline">
                    <span class="no-underline mx-auto">
                        <i class="fa-regular fa-chart-bar h-4 w-4 text-white inline mr-1 -mt-1"></i>
                        </svg> View Analytics </span>
                    <!---->
                </a>
            </div>
            @endif
        </div>

        <div class="flex-1 flex" style="overflow: hidden">
            <div class="flex-1" style="overflow-y: scroll">
                @include('survey::standard', ['survey' => $survey])
                {{-- <livewire:survey-creation-preview-screen /> --}}
            </div>
        </div>

    </div>

    @if (isset($selectedQuestion))
    <livewire:question-settings-modal :question="$selectedQuestion" wire:key="{{ $selectedQuestion->id }}" />
    @endif

    <!-- Modal backdrop -->
    <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak></div>
    <!-- Modal dialog -->
    <div id="feedback-modal" class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center px-4 sm:px-6" role="dialog" aria-modal="true" x-show="modalOpen" x-transition:enter="transition ease-in-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4" x-cloak>
        <div class="bg-white rounded shadow-lg overflow-auto max-w-3xl w-full max-h-full" @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
            <!-- Modal header -->
            <div class="px-5 py-3 border-slate-200">
                <div class="flex justify-between items-center">
                    <div class="font-semibold text-slate-800"></div>
                    <button class="text-slate-400 hover:text-slate-500" @click="modalOpen = false">
                        <div class="sr-only">Close</div>
                        <svg class="w-4 h-4 fill-current">
                            <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Modal content -->
            <div class="px-5 py-4">
                <div class="sm:flex sm:flex-col sm:items-start">
                    <div class="flex w-full justify-center mb-4">
                        <div class="w-14 h-14 rounded-full flex justify-center items-center bg-blue-100 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 text-blue">

                                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 w-full">
                        <h2 class="text-2xl font-semibold text-center text-gray-900">
                            Choose a block to add to your form
                        </h2>
                    </div>
                </div>
                <div class="mt-2 w-full">
                    <p class="text-gray-500 uppercase text-xs font-semibold mt-8">Text Fields</p>
                    <div class="grid grid-cols-4 gap-4 mt-2">
                        <div role="button" class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col" @click="modalOpen = false" wire:click="pick('short-answer')">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-regular fa-font h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Short Answer
                            </p>
                        </div>
                        <div role="button" class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col" @click="modalOpen = false" wire:click="pick('long-answer')">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-solid fa-comment h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Long Answer
                            </p>
                        </div>
                        <div @click="modalOpen = false" wire:click="pick('date')" role="button" class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-regular fa-calendar h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Date
                            </p>
                        </div>
                        <div @click="modalOpen = false" wire:click="pick('time')" role="button" class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-regular fa-clock h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Time
                            </p>
                        </div>
                    </div>
                    <p class="text-gray-500 uppercase text-xs font-semibold mt-8">Choices</p>
                    <div class="grid grid-cols-4 gap-4 mt-2">
                        <div @click="modalOpen = false" wire:click="pick('checkbox')" role="button" class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-regular fa-check h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-bold mb-4">
                                Checkbox
                            </p>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-light mb-4">
                                Used for multiple choice questions
                            </p>
                        </div>
                        <div @click="modalOpen = false" wire:click="pick('radio')" role="button" class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-solid fa-circle-dot h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-bold mb-4">
                                Radio
                            </p>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-light mb-4">
                                Used for likert scales, and single choice questions
                            </p>
                        </div>
                        <div @click="modalOpen = false" wire:click="pick('range')" role="button" class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-solid fa-sliders h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-bold mb-4">
                                Range Slider
                            </p>
                        </div>
                        {{-- <div @click="modalOpen = false" wire:click="pick('likert')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-regular fa-face-smile h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Likert Scale
                            </p>
                        </div> --}}
                        {{-- <div  @click="modalOpen = false"  wire:click="pick('radio-grid')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto py-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7">
                                    </path>
                                </svg></div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Radio Grid
                            </p>
                        </div> --}}
                    </div>
                    {{-- <p class="text-gray-500 uppercase text-xs font-semibold mt-8">File Uploads</p>
                    <div class="grid grid-cols-4 gap-4 mt-2">
                        <div @click="modalOpen = false" wire:click="pick('photo')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-regular fa-image h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Photo Upload
                            </p>
                        </div>

                        <div @click="modalOpen = false" wire:click="pick('document')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-regular fa-file h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Document Upload
                            </p>
                        </div>

                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</div>

@if ($survey->framework_id == null)
@section('footer-scripts')
<script type='text/javascript' defer='defer'>
    document.addEventListener('livewire:load', function() {
        window.addEventListener("DOMContentLoaded", (event) => {
            document.querySelectorAll(".sortable").forEach(node => {
                new Sortable(node, {
                    group: 'scoreboard'
                    , direction: 'vertical'
                    , animation: 250
                    , scroll: true
                    , bubbleScroll: true,

                    onMove: function(evt, originalEvent) {
                        if (
                            (evt.dragged.classList.contains("section-group") &&
                                evt.to.classList.contains("group__goals"))
                        ) {
                            return false;
                        } else if (evt.dragged.classList.contains(
                                "group__goals__item") && evt
                            .to
                            .classList.contains("section-list")) {
                            return false;
                        }
                    }
                    , onEnd: function(evt) {
                        isDraggingSection = evt.item.classList.contains(
                            'section-group');

                        if (isDraggingSection) {
                            @this.updateSectionOrder(
                                evt.item.dataset.sectionId
                                , evt
                                .oldIndex
                                , evt.newIndex
                            )
                        } else {
                            // check if field is transferred from one section to another
                            // then change section id
                            questionId = evt.item.dataset.questionId;
                            newSectionId = evt.to.dataset.sectionId

                            isChangingSection = newSectionId != evt.from
                                .dataset.sectionId
                            if (isChangingSection) {
                                @this.updateQuestionSectionId(
                                    questionId
                                    , newSectionId
                                )
                            }

                            // update indices
                            @this.updateQuestionOrder(
                                questionId
                                , evt.newIndex
                            )
                        }

                    }
                });
            });
        });
    })

</script>
@endsection
@endif
