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
                <div class="sortable bg-white overflow-hidden w-full mx-auto transition-colors" id="section-list">
                    @foreach ($survey->sections as $index => $section)
                        <div class="w-full mx-auto transition-colors border section-group [&:not(:last-child)]:border-b-0"
                            wire:key="section-{{ $section->id }}">
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
                            <div class="section-group__items sortable ml-10">
                                @foreach ($section->questions as $questionIndex => $question)
                                    <div
                                        class="flex items-center space-x-1 group py-2 pr-4 relative w-full mx-auto transition-colors border-t">
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

                            {{-- <div class="w-full mx-auto transition-colors">
                                @foreach ($sectionData['forms'] as $index => $form)
                                    <div class="ml-8 flex items-center space-x-1 group py-2 pr-4 relative">
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
                                                        {{ $form['title'] }}
                                                    </div>
                                                </div>
                                                <div x-show=isEditing class="flex flex-col">
                                                    <input type="text"
                                                        class="form-input w-full px-2 border border-gray-400 text-lg shadow-inner"
                                                        x-ref="textInput"
                                                        wire:model="sections.{{ $sectionId }}.forms.{{ $index }}.title"
                                                        x-on:keydown.enter="isEditing = false"
                                                        x-on:blur="isEditing = false" />
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-400 w-full truncate pl-2">
                                                <span class="capitalize">{{ str_replace('-', ' ', $form['type']) }}
                                                    Input</span>
                                            </p>
                                        </div>

                                        <button wire:click="deleteForm('{{ $sectionId }}', '{{ $index }}')"
                                            class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2">
                                            <i class="fa-regular fa-trash-can w-4 h-4 fill-current text-red-600"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div> --}}
                        </div>
                    @endforeach
                </div>
                {{-- 
                <div class="bg-white overflow-hidden rounded-md w-full mx-auto border transition-colors">
                    <div class="w-full mx-auto transition-colors border-b">
                        <div class="flex items-center space-x-1 group py-2 pr-4 relative">
                            <div class="cursor-move draggable p-2 -mr-2"><svg viewBox="0 0 18 8" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400">
                                    <path d="M1.5 1.0835H16.5M1.5 6.91683H16.5" stroke="currentColor"
                                        stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg></div>
                            <div class="flex flex-col flex-grow truncate">
                                <div tabindex="0"
                                    class="relative max-w-full flex items-center hover:bg-gray-100 rounded px-2 cursor-pointer"
                                    style="height: auto;">
                                    <div class="cursor-pointer max-w-full truncate"> Name </div>
                                    <!---->
                                </div>
                                <p class="text-xs text-gray-400 w-full truncate pl-2"><span class="capitalize">text
                                        Input</span></p><template></template>
                            </div><button
                                class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2 hidden text-blue-500 group-hover:md:block"><svg
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4">
                                    <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg></button><button
                                class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2 hidden md:block">
                                <div class="w-4 h-4 text-center font-bold text-3xl text-red-500"><svg
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4">
                                        <path
                                            d="M12 2V12M12 12V22M12 12L4.93 4.93M12 12L19.07 19.07M12 12H2M12 12H22M12 12L4.93 19.07M12 12L19.07 4.93"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg></div>
                            </button><button
                                class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2"><svg
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600">
                                    <g clip-path="url(#clip0_1027_7210)">
                                        <path
                                            d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M19.4 15C19.2669 15.3016 19.2272 15.6362 19.286 15.9606C19.3448 16.285 19.4995 16.5843 19.73 16.82L19.79 16.88C19.976 17.0657 20.1235 17.2863 20.2241 17.5291C20.3248 17.7719 20.3766 18.0322 20.3766 18.295C20.3766 18.5578 20.3248 18.8181 20.2241 19.0609C20.1235 19.3037 19.976 19.5243 19.79 19.71C19.6043 19.896 19.3837 20.0435 19.1409 20.1441C18.8981 20.2448 18.6378 20.2966 18.375 20.2966C18.1122 20.2966 17.8519 20.2448 17.6091 20.1441C17.3663 20.0435 17.1457 19.896 16.96 19.71L16.9 19.65C16.6643 19.4195 16.365 19.2648 16.0406 19.206C15.7162 19.1472 15.3816 19.1869 15.08 19.32C14.7842 19.4468 14.532 19.6572 14.3543 19.9255C14.1766 20.1938 14.0813 20.5082 14.08 20.83V21C14.08 21.5304 13.8693 22.0391 13.4942 22.4142C13.1191 22.7893 12.6104 23 12.08 23C11.5496 23 11.0409 22.7893 10.6658 22.4142C10.2907 22.0391 10.08 21.5304 10.08 21V20.91C10.0723 20.579 9.96512 20.258 9.77251 19.9887C9.5799 19.7194 9.31074 19.5143 9 19.4C8.69838 19.2669 8.36381 19.2272 8.03941 19.286C7.71502 19.3448 7.41568 19.4995 7.18 19.73L7.12 19.79C6.93425 19.976 6.71368 20.1235 6.47088 20.2241C6.22808 20.3248 5.96783 20.3766 5.705 20.3766C5.44217 20.3766 5.18192 20.3248 4.93912 20.2241C4.69632 20.1235 4.47575 19.976 4.29 19.79C4.10405 19.6043 3.95653 19.3837 3.85588 19.1409C3.75523 18.8981 3.70343 18.6378 3.70343 18.375C3.70343 18.1122 3.75523 17.8519 3.85588 17.6091C3.95653 17.3663 4.10405 17.1457 4.29 16.96L4.35 16.9C4.58054 16.6643 4.73519 16.365 4.794 16.0406C4.85282 15.7162 4.81312 15.3816 4.68 15.08C4.55324 14.7842 4.34276 14.532 4.07447 14.3543C3.80618 14.1766 3.49179 14.0813 3.17 14.08H3C2.46957 14.08 1.96086 13.8693 1.58579 13.4942C1.21071 13.1191 1 12.6104 1 12.08C1 11.5496 1.21071 11.0409 1.58579 10.6658C1.96086 10.2907 2.46957 10.08 3 10.08H3.09C3.42099 10.0723 3.742 9.96512 4.0113 9.77251C4.28059 9.5799 4.48572 9.31074 4.6 9C4.73312 8.69838 4.77282 8.36381 4.714 8.03941C4.65519 7.71502 4.50054 7.41568 4.27 7.18L4.21 7.12C4.02405 6.93425 3.87653 6.71368 3.77588 6.47088C3.67523 6.22808 3.62343 5.96783 3.62343 5.705C3.62343 5.44217 3.67523 5.18192 3.77588 4.93912C3.87653 4.69632 4.02405 4.47575 4.21 4.29C4.39575 4.10405 4.61632 3.95653 4.85912 3.85588C5.10192 3.75523 5.36217 3.70343 5.625 3.70343C5.88783 3.70343 6.14808 3.75523 6.39088 3.85588C6.63368 3.95653 6.85425 4.10405 7.04 4.29L7.1 4.35C7.33568 4.58054 7.63502 4.73519 7.95941 4.794C8.28381 4.85282 8.61838 4.81312 8.92 4.68H9C9.29577 4.55324 9.54802 4.34276 9.72569 4.07447C9.90337 3.80618 9.99872 3.49179 10 3.17V3C10 2.46957 10.2107 1.96086 10.5858 1.58579C10.9609 1.21071 11.4696 1 12 1C12.5304 1 13.0391 1.21071 13.4142 1.58579C13.7893 1.96086 14 2.46957 14 3V3.09C14.0013 3.41179 14.0966 3.72618 14.2743 3.99447C14.452 4.26276 14.7042 4.47324 15 4.6C15.3016 4.73312 15.6362 4.77282 15.9606 4.714C16.285 4.65519 16.5843 4.50054 16.82 4.27L16.88 4.21C17.0657 4.02405 17.2863 3.87653 17.5291 3.77588C17.7719 3.67523 18.0322 3.62343 18.295 3.62343C18.5578 3.62343 18.8181 3.67523 19.0609 3.77588C19.3037 3.87653 19.5243 4.02405 19.71 4.21C19.896 4.39575 20.0435 4.61632 20.1441 4.85912C20.2448 5.10192 20.2966 5.36217 20.2966 5.625C20.2966 5.88783 20.2448 6.14808 20.1441 6.39088C20.0435 6.63368 19.896 6.85425 19.71 7.04L19.65 7.1C19.4195 7.33568 19.2648 7.63502 19.206 7.95941C19.1472 8.28381 19.1869 8.61838 19.32 8.92V9C19.4468 9.29577 19.6572 9.54802 19.9255 9.72569C20.1938 9.90337 20.5082 9.99872 20.83 10H21C21.5304 10 22.0391 10.2107 22.4142 10.5858C22.7893 10.9609 23 11.4696 23 12C23 12.5304 22.7893 13.0391 22.4142 13.4142C22.0391 13.7893 21.5304 14 21 14H20.91C20.5882 14.0013 20.2738 14.0966 20.0055 14.2743C19.7372 14.452 19.5268 14.7042 19.4 15Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1027_7210">
                                            <rect width="24" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg></button>
                        </div>
                    </div>
                    <div class="w-full mx-auto transition-colors border-b">
                        <div class="flex items-center space-x-1 group py-2 pr-4 relative">
                            <div class="cursor-move draggable p-2 -mr-2"><svg viewBox="0 0 18 8" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400">
                                    <path d="M1.5 1.0835H16.5M1.5 6.91683H16.5" stroke="currentColor"
                                        stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg></div>
                            <div class="flex flex-col flex-grow truncate">
                                <div tabindex="0"
                                    class="relative max-w-full flex items-center hover:bg-gray-100 rounded px-2 cursor-pointer"
                                    style="height: auto;">
                                    <div class="cursor-pointer max-w-full truncate"> Email </div>
                                    <!---->
                                </div>
                                <p class="text-xs text-gray-400 w-full truncate pl-2"><span class="capitalize">email
                                        Input</span></p><template></template>
                            </div><button
                                class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2 hidden text-blue-500 group-hover:md:block"><svg
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4">
                                    <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg></button><button
                                class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2 hidden group-hover:md:block">
                                <div class="w-4 h-4 text-center font-bold text-3xl text-gray-500"><svg
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4">
                                        <path
                                            d="M12 2V12M12 12V22M12 12L4.93 4.93M12 12L19.07 19.07M12 12H2M12 12H22M12 12L4.93 19.07M12 12L19.07 4.93"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg></div>
                            </button><button
                                class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2"><svg
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600">
                                    <g clip-path="url(#clip0_1027_7210)">
                                        <path
                                            d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M19.4 15C19.2669 15.3016 19.2272 15.6362 19.286 15.9606C19.3448 16.285 19.4995 16.5843 19.73 16.82L19.79 16.88C19.976 17.0657 20.1235 17.2863 20.2241 17.5291C20.3248 17.7719 20.3766 18.0322 20.3766 18.295C20.3766 18.5578 20.3248 18.8181 20.2241 19.0609C20.1235 19.3037 19.976 19.5243 19.79 19.71C19.6043 19.896 19.3837 20.0435 19.1409 20.1441C18.8981 20.2448 18.6378 20.2966 18.375 20.2966C18.1122 20.2966 17.8519 20.2448 17.6091 20.1441C17.3663 20.0435 17.1457 19.896 16.96 19.71L16.9 19.65C16.6643 19.4195 16.365 19.2648 16.0406 19.206C15.7162 19.1472 15.3816 19.1869 15.08 19.32C14.7842 19.4468 14.532 19.6572 14.3543 19.9255C14.1766 20.1938 14.0813 20.5082 14.08 20.83V21C14.08 21.5304 13.8693 22.0391 13.4942 22.4142C13.1191 22.7893 12.6104 23 12.08 23C11.5496 23 11.0409 22.7893 10.6658 22.4142C10.2907 22.0391 10.08 21.5304 10.08 21V20.91C10.0723 20.579 9.96512 20.258 9.77251 19.9887C9.5799 19.7194 9.31074 19.5143 9 19.4C8.69838 19.2669 8.36381 19.2272 8.03941 19.286C7.71502 19.3448 7.41568 19.4995 7.18 19.73L7.12 19.79C6.93425 19.976 6.71368 20.1235 6.47088 20.2241C6.22808 20.3248 5.96783 20.3766 5.705 20.3766C5.44217 20.3766 5.18192 20.3248 4.93912 20.2241C4.69632 20.1235 4.47575 19.976 4.29 19.79C4.10405 19.6043 3.95653 19.3837 3.85588 19.1409C3.75523 18.8981 3.70343 18.6378 3.70343 18.375C3.70343 18.1122 3.75523 17.8519 3.85588 17.6091C3.95653 17.3663 4.10405 17.1457 4.29 16.96L4.35 16.9C4.58054 16.6643 4.73519 16.365 4.794 16.0406C4.85282 15.7162 4.81312 15.3816 4.68 15.08C4.55324 14.7842 4.34276 14.532 4.07447 14.3543C3.80618 14.1766 3.49179 14.0813 3.17 14.08H3C2.46957 14.08 1.96086 13.8693 1.58579 13.4942C1.21071 13.1191 1 12.6104 1 12.08C1 11.5496 1.21071 11.0409 1.58579 10.6658C1.96086 10.2907 2.46957 10.08 3 10.08H3.09C3.42099 10.0723 3.742 9.96512 4.0113 9.77251C4.28059 9.5799 4.48572 9.31074 4.6 9C4.73312 8.69838 4.77282 8.36381 4.714 8.03941C4.65519 7.71502 4.50054 7.41568 4.27 7.18L4.21 7.12C4.02405 6.93425 3.87653 6.71368 3.77588 6.47088C3.67523 6.22808 3.62343 5.96783 3.62343 5.705C3.62343 5.44217 3.67523 5.18192 3.77588 4.93912C3.87653 4.69632 4.02405 4.47575 4.21 4.29C4.39575 4.10405 4.61632 3.95653 4.85912 3.85588C5.10192 3.75523 5.36217 3.70343 5.625 3.70343C5.88783 3.70343 6.14808 3.75523 6.39088 3.85588C6.63368 3.95653 6.85425 4.10405 7.04 4.29L7.1 4.35C7.33568 4.58054 7.63502 4.73519 7.95941 4.794C8.28381 4.85282 8.61838 4.81312 8.92 4.68H9C9.29577 4.55324 9.54802 4.34276 9.72569 4.07447C9.90337 3.80618 9.99872 3.49179 10 3.17V3C10 2.46957 10.2107 1.96086 10.5858 1.58579C10.9609 1.21071 11.4696 1 12 1C12.5304 1 13.0391 1.21071 13.4142 1.58579C13.7893 1.96086 14 2.46957 14 3V3.09C14.0013 3.41179 14.0966 3.72618 14.2743 3.99447C14.452 4.26276 14.7042 4.47324 15 4.6C15.3016 4.73312 15.6362 4.77282 15.9606 4.714C16.285 4.65519 16.5843 4.50054 16.82 4.27L16.88 4.21C17.0657 4.02405 17.2863 3.87653 17.5291 3.77588C17.7719 3.67523 18.0322 3.62343 18.295 3.62343C18.5578 3.62343 18.8181 3.67523 19.0609 3.77588C19.3037 3.87653 19.5243 4.02405 19.71 4.21C19.896 4.39575 20.0435 4.61632 20.1441 4.85912C20.2448 5.10192 20.2966 5.36217 20.2966 5.625C20.2966 5.88783 20.2448 6.14808 20.1441 6.39088C20.0435 6.63368 19.896 6.85425 19.71 7.04L19.65 7.1C19.4195 7.33568 19.2648 7.63502 19.206 7.95941C19.1472 8.28381 19.1869 8.61838 19.32 8.92V9C19.4468 9.29577 19.6572 9.54802 19.9255 9.72569C20.1938 9.90337 20.5082 9.99872 20.83 10H21C21.5304 10 22.0391 10.2107 22.4142 10.5858C22.7893 10.9609 23 11.4696 23 12C23 12.5304 22.7893 13.0391 22.4142 13.4142C22.0391 13.7893 21.5304 14 21 14H20.91C20.5882 14.0013 20.2738 14.0966 20.0055 14.2743C19.7372 14.452 19.5268 14.7042 19.4 15Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1027_7210">
                                            <rect width="24" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg></button>
                        </div>
                    </div>
                    <div class="w-full mx-auto transition-colors">
                        <div class="flex items-center space-x-1 group py-2 pr-4 relative">
                            <div class="cursor-move draggable p-2 -mr-2"><svg viewBox="0 0 18 8" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400">
                                    <path d="M1.5 1.0835H16.5M1.5 6.91683H16.5" stroke="currentColor"
                                        stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg></div>
                            <div class="flex flex-col flex-grow truncate">
                                <div tabindex="0"
                                    class="relative max-w-full flex items-center hover:bg-gray-100 rounded px-2 cursor-pointer"
                                    style="height: auto;">
                                    <div class="cursor-pointer max-w-full truncate"> Message </div>
                                    <!---->
                                </div>
                                <p class="text-xs text-gray-400 w-full truncate pl-2"><span class="capitalize">text
                                        Input</span></p><template></template>
                            </div><button
                                class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2 hidden text-blue-500 group-hover:md:block"><svg
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4">
                                    <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg></button><button
                                class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2 hidden group-hover:md:block">
                                <div class="w-4 h-4 text-center font-bold text-3xl text-gray-500"><svg
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4">
                                        <path
                                            d="M12 2V12M12 12V22M12 12L4.93 4.93M12 12L19.07 19.07M12 12H2M12 12H22M12 12L4.93 19.07M12 12L19.07 4.93"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg></div>
                            </button><button
                                class="hover:bg-nt-blue-lighter rounded transition-colors cursor-pointer p-2"><svg
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600">
                                    <g clip-path="url(#clip0_1027_7210)">
                                        <path
                                            d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M19.4 15C19.2669 15.3016 19.2272 15.6362 19.286 15.9606C19.3448 16.285 19.4995 16.5843 19.73 16.82L19.79 16.88C19.976 17.0657 20.1235 17.2863 20.2241 17.5291C20.3248 17.7719 20.3766 18.0322 20.3766 18.295C20.3766 18.5578 20.3248 18.8181 20.2241 19.0609C20.1235 19.3037 19.976 19.5243 19.79 19.71C19.6043 19.896 19.3837 20.0435 19.1409 20.1441C18.8981 20.2448 18.6378 20.2966 18.375 20.2966C18.1122 20.2966 17.8519 20.2448 17.6091 20.1441C17.3663 20.0435 17.1457 19.896 16.96 19.71L16.9 19.65C16.6643 19.4195 16.365 19.2648 16.0406 19.206C15.7162 19.1472 15.3816 19.1869 15.08 19.32C14.7842 19.4468 14.532 19.6572 14.3543 19.9255C14.1766 20.1938 14.0813 20.5082 14.08 20.83V21C14.08 21.5304 13.8693 22.0391 13.4942 22.4142C13.1191 22.7893 12.6104 23 12.08 23C11.5496 23 11.0409 22.7893 10.6658 22.4142C10.2907 22.0391 10.08 21.5304 10.08 21V20.91C10.0723 20.579 9.96512 20.258 9.77251 19.9887C9.5799 19.7194 9.31074 19.5143 9 19.4C8.69838 19.2669 8.36381 19.2272 8.03941 19.286C7.71502 19.3448 7.41568 19.4995 7.18 19.73L7.12 19.79C6.93425 19.976 6.71368 20.1235 6.47088 20.2241C6.22808 20.3248 5.96783 20.3766 5.705 20.3766C5.44217 20.3766 5.18192 20.3248 4.93912 20.2241C4.69632 20.1235 4.47575 19.976 4.29 19.79C4.10405 19.6043 3.95653 19.3837 3.85588 19.1409C3.75523 18.8981 3.70343 18.6378 3.70343 18.375C3.70343 18.1122 3.75523 17.8519 3.85588 17.6091C3.95653 17.3663 4.10405 17.1457 4.29 16.96L4.35 16.9C4.58054 16.6643 4.73519 16.365 4.794 16.0406C4.85282 15.7162 4.81312 15.3816 4.68 15.08C4.55324 14.7842 4.34276 14.532 4.07447 14.3543C3.80618 14.1766 3.49179 14.0813 3.17 14.08H3C2.46957 14.08 1.96086 13.8693 1.58579 13.4942C1.21071 13.1191 1 12.6104 1 12.08C1 11.5496 1.21071 11.0409 1.58579 10.6658C1.96086 10.2907 2.46957 10.08 3 10.08H3.09C3.42099 10.0723 3.742 9.96512 4.0113 9.77251C4.28059 9.5799 4.48572 9.31074 4.6 9C4.73312 8.69838 4.77282 8.36381 4.714 8.03941C4.65519 7.71502 4.50054 7.41568 4.27 7.18L4.21 7.12C4.02405 6.93425 3.87653 6.71368 3.77588 6.47088C3.67523 6.22808 3.62343 5.96783 3.62343 5.705C3.62343 5.44217 3.67523 5.18192 3.77588 4.93912C3.87653 4.69632 4.02405 4.47575 4.21 4.29C4.39575 4.10405 4.61632 3.95653 4.85912 3.85588C5.10192 3.75523 5.36217 3.70343 5.625 3.70343C5.88783 3.70343 6.14808 3.75523 6.39088 3.85588C6.63368 3.95653 6.85425 4.10405 7.04 4.29L7.1 4.35C7.33568 4.58054 7.63502 4.73519 7.95941 4.794C8.28381 4.85282 8.61838 4.81312 8.92 4.68H9C9.29577 4.55324 9.54802 4.34276 9.72569 4.07447C9.90337 3.80618 9.99872 3.49179 10 3.17V3C10 2.46957 10.2107 1.96086 10.5858 1.58579C10.9609 1.21071 11.4696 1 12 1C12.5304 1 13.0391 1.21071 13.4142 1.58579C13.7893 1.96086 14 2.46957 14 3V3.09C14.0013 3.41179 14.0966 3.72618 14.2743 3.99447C14.452 4.26276 14.7042 4.47324 15 4.6C15.3016 4.73312 15.6362 4.77282 15.9606 4.714C16.285 4.65519 16.5843 4.50054 16.82 4.27L16.88 4.21C17.0657 4.02405 17.2863 3.87653 17.5291 3.77588C17.7719 3.67523 18.0322 3.62343 18.295 3.62343C18.5578 3.62343 18.8181 3.67523 19.0609 3.77588C19.3037 3.87653 19.5243 4.02405 19.71 4.21C19.896 4.39575 20.0435 4.61632 20.1441 4.85912C20.2448 5.10192 20.2966 5.36217 20.2966 5.625C20.2966 5.88783 20.2448 6.14808 20.1441 6.39088C20.0435 6.63368 19.896 6.85425 19.71 7.04L19.65 7.1C19.4195 7.33568 19.2648 7.63502 19.206 7.95941C19.1472 8.28381 19.1869 8.61838 19.32 8.92V9C19.4468 9.29577 19.6572 9.54802 19.9255 9.72569C20.1938 9.90337 20.5082 9.99872 20.83 10H21C21.5304 10 22.0391 10.2107 22.4142 10.5858C22.7893 10.9609 23 11.4696 23 12C23 12.5304 22.7893 13.0391 22.4142 13.4142C22.0391 13.7893 21.5304 14 21 14H20.91C20.5882 14.0013 20.2738 14.0966 20.0055 14.2743C19.7372 14.452 19.5268 14.7042 19.4 15Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1027_7210">
                                            <rect width="24" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg></button>
                        </div>
                    </div>
                </div> --}}
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
