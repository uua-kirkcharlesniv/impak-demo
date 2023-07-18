<div class="overflow-hidden" x-data="{ modalOpen: false }">
    <div class="h-[calc(100vh-74px)] flex">
        <!-- Fixed sidebar -->
        <div class="w-1/3 bg-white overflow-y-auto mr-2">
            <x-survey-tab isFirst="true" title="setup" icon="fa-screwdriver-wrench">
                <div>
                    <label class="block text-sm font-medium mb-1" for="name">Your survey name</label>
                    <input id="name" class="form-input w-full" type="text" placeholder=""
                        wire:model.lazy="survey.name" wire:change="onSurveyNameChanged($event.target.value)" />
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1" for="countAllowedSubmissions">Maximum number of
                        submissions</label>
                    <input id="countAllowedSubmissions" class="form-input w-full" type="number" min="0"
                        max="999" wire:model.lazy="survey.settings.limit-per-participant"
                        wire:change="onMaxSubmissionsChanged($event.target.value)"
                        placeholder="Leave blank to set to 1" />
                </div>
            </x-survey-tab>
            <x-survey-tab title="rationale" icon="fa-brain">
                <div>
                    <label class="block text-sm font-medium mb-1" for="rationale_title">Title</label>
                    <input id="rationale_title" class="form-input w-full" type="text" placeholder=""
                        wire:model.lazy="rationale" />
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1" for="rationale_description">Description</label>
                    <textarea id="rationale_description" class="form-input w-full" type="text" placeholder=""
                        wire:model.lazy="rationale_description"></textarea>
                </div>

                <div x-data="{ option: '' }">
                    <label class="block text-sm font-medium mb-1" for="survey_type">Survey Type</label>
                    <select class="form-select w-full" id="survey_type" x-model="option" wire:model="survey_type">
                        <option value="post_event">Post Event Survey</option>
                        <option value="needs">Needs Analysis Survey</option>
                        <option value="employee">Employee Engagement Survey</option>
                        <option value="market">Market Research Survey</option>
                        <option value="opinion">Opinion Poll</option>
                        <option value="demographic">Demographic Survey</option>
                        <option value="product">Product Feedback Survey</option>
                        <option value="event">Event Evaluation Survey</option>
                        <option value="website">Website Feedback Survey</option>
                        <option value="training">Training Needs Assessment</option>
                        <option value="post_purchase">Post Purchase Survey</option>
                        <option value="others">Others</option>
                    </select>

                    <div x-show="option == 'others'">
                        <input id="manual_survey_type" class="form-input w-full my-2" type="text"
                            placeholder="Training Needs Survey" wire:model.lazy="manual_survey_type" />
                        <label class="block text-sm font-medium mb-1" for="manual_sections">Section names</label>
                        <input id="manual_sections" class="form-input w-full" type="text"
                            wire:model.lazy="manual_sections"
                            placeholder="Employee Demographics, Knowledge and Skills Capacity, ..." />
                        <p id="helper-text-explanation" class="text-sm text-gray-500">Delimited by comma.</p>
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm font-medium mb-1" for="sub_specialization">Sub-specialization /
                            Target Focus</label>
                        <input id="sub_specialization" class="form-input w-full" type="text"
                            placeholder="This is optional, but would help our AI to analyze more."
                            wire:model.lazy="sub_specialization" />
                    </div>

                    <div class="container mt-4 mx-0 w-full flex flex-col items-center">
                        <button
                            class="w-full bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-black py-2 px-4 border border-blue rounded"
                            @click.prevent="modalOpen = true" aria-controls="feedback-modal">

                            <span class="hidden xs:block ml-2">
                                Analyze & Generate
                            </span>
                        </button>
                    </div>
                </div>
            </x-survey-tab>
            <x-survey-tab title="respondents" icon="fa-users">
                <livewire:survey-manager.respondent.user />
            </x-survey-tab>
            <x-survey-tab title="schedule" icon="fa-calendar-days">
                <div>
                    <label class="block text-sm font-medium mb-1" for="normal">Open the form on</label>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Start -->
                        <div class="relative w-full">
                            <input
                                class="w-full datepicker form-input pl-9 text-slate-500 hover:text-slate-600 font-medium focus:border-slate-300 w-160"
                                placeholder="Select date" />
                            <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                <svg class="w-4 h-4 fill-current text-slate-500 ml-3" viewBox="0 0 16 16">
                                    <path
                                        d="M15 2h-2V0h-2v2H9V0H7v2H5V0H3v2H1a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V3a1 1 0 00-1-1zm-1 12H2V6h12v8z" />
                                </svg>
                            </div>
                        </div>
                        <div class="relative w-full">
                            <input
                                class="w-full timepicker form-input pl-9 text-slate-500 hover:text-slate-600 font-medium focus:border-slate-300 w-160"
                                placeholder="Select time" />
                            <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                <i class="fa-solid fa-clock w-4 h-4 fill-current text-slate-500 ml-3"></i>
                            </div>
                        </div>
                        <!-- End -->
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1" for="normal">Close the form on</label>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Start -->
                        <div class="relative w-full">
                            <input
                                class="w-full datepicker form-input pl-9 text-slate-500 hover:text-slate-600 font-medium focus:border-slate-300 w-160"
                                placeholder="Select date" />
                            <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                <svg class="w-4 h-4 fill-current text-slate-500 ml-3" viewBox="0 0 16 16">
                                    <path
                                        d="M15 2h-2V0h-2v2H9V0H7v2H5V0H3v2H1a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V3a1 1 0 00-1-1zm-1 12H2V6h12v8z" />
                                </svg>
                            </div>
                        </div>
                        <div class="relative w-full">
                            <input
                                class="w-full timepicker form-input pl-9 text-slate-500 hover:text-slate-600 font-medium focus:border-slate-300 w-160"
                                placeholder="Select time" />
                            <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                <i class="fa-solid fa-clock w-4 h-4 fill-current text-slate-500 ml-3"></i>
                            </div>
                        </div>
                        <!-- End -->
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1" for="normal">Set the form recurring on every:
                    </label>
                    <div class="grid grid-cols-3">
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-indigo-600" id="monday"
                                    name="monday">
                                <span class="ml-2">Monday</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-indigo-600" id="tuesday"
                                    name="tuesday">
                                <span class="ml-2">Tuesday</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-indigo-600" id="wednesday"
                                    name="wednesday">
                                <span class="ml-2">Wednesday</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-indigo-600" id="thursday"
                                    name="thursday">
                                <span class="ml-2">Thursday</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-indigo-600" id="friday"
                                    name="friday">
                                <span class="ml-2">Friday</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-indigo-600" id="saturday"
                                    name="saturday">
                                <span class="ml-2">Saturday</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-indigo-600" id="sunday"
                                    name="sunday">
                                <span class="ml-2">Sunday</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1" for="normal">Start time</label>
                            <div class="relative w-full">
                                <input
                                    class="w-full timepicker form-input pl-9 text-slate-500 hover:text-slate-600 font-medium focus:border-slate-300 w-160"
                                    placeholder="Select time" />
                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                    <i class="fa-solid fa-clock w-4 h-4 fill-current text-slate-500 ml-3"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1" for="normal">End time</label>
                            <div class="relative w-full">
                                <input
                                    class="w-full timepicker form-input pl-9 text-slate-500 hover:text-slate-600 font-medium focus:border-slate-300 w-160"
                                    placeholder="Select time" />
                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                    <i class="fa-solid fa-clock w-4 h-4 fill-current text-slate-500 ml-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-survey-tab>
            <x-survey-tab title="form" icon="fa-clipboard-question">
                <button
                    class="w-full mb-4 bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-black py-2 px-4 border border-blue rounded"
                    wire:click="addSection">
                    <span class="hidden xs:block ml-2">
                        Add Section
                    </span>
                </button>
                <div
                    class="sortable section-list scoreboard bg-white overflow-hidden w-full mx-auto transition-colors ">
                    @foreach ($survey->sections as $index => $section)
                        <div class="w-full mx-auto transition-colors border section-group [&:not(:last-child)]:border-b-0"
                            wire:key="section-{{ $section->id }}" data-section-id="{{ $section->id }}">
                            <div class="flex items-center space-x-1 group py-2 pr-4 relative">
                                <div class="cursor-move draggable p-2 -mr-2">
                                    <i class="fa-solid fa-grip-lines h-4 w-4 text-gray-400"></i>
                                </div>

                                <div class="flex flex-col flex-grow truncate" x-data="{
                                    isEditing: false,
                                    focus: function() {
                                        const textInput = this.$refs.textInput;
                                        textInput.focus();
                                        textInput.select();
                                    }
                                }" x-cloak>
                                    <div tabindex="0"
                                        class="relative max-w-full flex items-center hover:bg-gray-100 rounded px-2 cursor-pointer"
                                        style="height: auto;" x-on:click="isEditing = true">
                                        <div x-show=!isEditing>
                                            <div class="cursor-pointer max-w-full truncate w-full">
                                                {{ $section->name }}
                                            </div>
                                        </div>
                                        <div x-show=isEditing class="flex flex-col">
                                            <input type="text"
                                                class="form-input w-full px-2 border border-gray-400 text-lg shadow-inner"
                                                x-ref="textInput"
                                                wire:model.lazy="survey.sections.{{ $index }}.name"
                                                wire:change="onSectionNameChanged({{ $section->id }}, $event.target.value)"
                                                x-on:keydown.enter="isEditing = false"
                                                x-on:blur="isEditing = false" />
                                        </div>
                                    </div>
                                </div>

                                <button @click.prevent="modalOpen = true"
                                    wire:click="toggleSectionSelection({{ $section->id }})"
                                    class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2">
                                    <i class="fa-regular fa-add w-4 h-4 fill-current text-indigo-600"></i>
                                </button>

                                <button wire:click="deleteSection('{{ $section->id }}')"
                                    class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2">
                                    <i class="fa-regular fa-trash-can w-4 h-4 fill-current text-red-600"></i>
                                </button>
                            </div>
                            <div class="group__goals sortable ml-10" data-section-id="{{ $section->id }}">
                                @foreach ($section->questions as $questionIndex => $question)
                                    <div data-question-id="{{ $question->id }}"
                                        class="group__goals__item flex items-center space-x-1 group py-2 pr-4 relative w-full mx-auto transition-colors border-t">
                                        <div class="cursor-move draggable p-2 -mr-2">
                                            <i class="fa-solid fa-grip-lines h-4 w-4 text-gray-400"></i>
                                        </div>

                                        <div class="flex flex-col flex-grow truncate" x-data="{
                                            isEditing: false,
                                            focus: function() {
                                                const textInput = this.$refs.textInput;
                                                textInput.focus();
                                                textInput.select();
                                            }
                                        }" x-cloak>
                                            <div tabindex="0"
                                                class="relative max-w-full flex items-center hover:bg-gray-100 rounded px-2 cursor-pointer"
                                                style="height: auto;" x-on:click="isEditing = true">
                                                <div x-show=!isEditing>
                                                    <div class="cursor-pointer max-w-full truncate w-full">
                                                        {{ $question->content }}

                                                    </div>
                                                    <span class="text-xs text-gray-600"
                                                        id="passwordHelp">{{ $question->formatted_type }}</span>
                                                </div>
                                                <div x-show=isEditing class="flex flex-col">
                                                    <input type="text"
                                                        class="form-input w-full px-2 border border-gray-400 text-lg shadow-inner"
                                                        x-ref="textInput"
                                                        wire:model.lazy="survey.sections.{{ $index }}.questions.{{ $questionIndex }}.content"
                                                        wire:change="onQuestionNameChange({{ $question->id }}, $event.target.value)"
                                                        x-on:keydown.enter="isEditing = false"
                                                        x-on:blur="isEditing = false" />
                                                </div>
                                            </div>
                                        </div>

                                        <button wire:click="deleteQuestion('{{ $question->id }}')"
                                            class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2">
                                            <i class="fa-regular fa-trash-can w-4 h-4 fill-current text-red-600"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-survey-tab>
            <x-survey-tab title="customization" icon="fa-bars">

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
            </x-survey-tab>
            {{-- </x-survey-tab> --}}


        </div>

        <div class="flex-1 flex overflow-hidden p-5">
            <div class="flex-1 overflow-y-auto mt-5">
                @include('survey::standard', ['survey' => $survey])
                {{-- <livewire:survey-creation-preview-screen /> --}}
            </div>
        </div>

    </div>

    <!-- Modal backdrop -->
    <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak></div>
    <!-- Modal dialog -->
    <div id="feedback-modal"
        class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center px-4 sm:px-6" role="dialog"
        aria-modal="true" x-show="modalOpen" x-transition:enter="transition ease-in-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4" x-cloak>
        <div class="bg-white rounded shadow-lg overflow-auto max-w-3xl w-full max-h-full"
            @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
            <!-- Modal header -->
            <div class="px-5 py-3 border-slate-200">
                <div class="flex justify-between items-center">
                    <div class="font-semibold text-slate-800"></div>
                    <button class="text-slate-400 hover:text-slate-500" @click="modalOpen = false">
                        <div class="sr-only">Close</div>
                        <svg class="w-4 h-4 fill-current">
                            <path
                                d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Modal content -->
            <div class="px-5 py-4">
                <div class="sm:flex sm:flex-col sm:items-start">
                    <div class="flex w-full justify-center mb-4">
                        <div class="w-14 h-14 rounded-full flex justify-center items-center bg-blue-100 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-10 h-10 text-blue">

                                <path fill-rule="evenodd"
                                    d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z"
                                    clip-rule="evenodd"></path>
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
                        <div role="button" class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col"
                            @click="modalOpen = false" wire:click="pick('short-answer')">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-regular fa-font h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Short Answer
                            </p>
                        </div>
                        <div role="button" class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col"
                            @click="modalOpen = false" wire:click="pick('long-answer')">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-solid fa-comment h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Long Answer
                            </p>
                        </div>
                        <div @click="modalOpen = false" wire:click="pick('date')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-regular fa-calendar h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Date
                            </p>
                        </div>
                        <div @click="modalOpen = false" wire:click="pick('time')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
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
                        <div @click="modalOpen = false" wire:click="pick('checkbox')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-regular fa-check h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Multiple Choice (Checkbox)
                            </p>
                        </div>
                        <div @click="modalOpen = false" wire:click="pick('radio')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-solid fa-circle-dot h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Single Choice (Radio)
                            </p>
                        </div>
                        <div @click="modalOpen = false" wire:click="pick('likert')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto my-auto py-4">
                                <center>
                                    <i class="fa-regular fa-face-smile h-8 w-8 text-gray-500 fa-2xl"></i>
                                </center>
                            </div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Likert Scale
                            </p>
                        </div>
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

@section('footer-scripts')
    <script type='text/javascript' defer='defer'>
        document.addEventListener('livewire:load', function() {
            window.addEventListener("DOMContentLoaded", (event) => {
                document.querySelectorAll(".sortable").forEach(node => {
                    new Sortable(node, {
                        group: 'scoreboard',
                        direction: 'vertical',
                        animation: 250,
                        scroll: true,
                        bubbleScroll: true,

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
                        },
                        onEnd: function(evt) {
                            isDraggingSection = evt.item.classList.contains(
                                'section-group');

                            if (isDraggingSection) {
                                @this.updateSectionOrder(
                                    evt.item.dataset.sectionId,
                                    evt
                                    .oldIndex,
                                    evt.newIndex
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
                                        questionId,
                                        newSectionId
                                    )
                                }

                                // update indices
                                @this.updateQuestionOrder(
                                    questionId,
                                    evt.newIndex
                                )
                            }

                        }
                    });
                });
            });
        })
    </script>
@endsection
