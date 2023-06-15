<div class="overflow-hidden">
    <div class="h-[calc(100vh-74px)] flex">
        <!-- Fixed sidebar -->
        <div class="w-1/3 bg-white overflow-y-auto py-4 mr-2">
            <x-survey-tab isFirst="true" title="setup" icon="fa-screwdriver-wrench">
                <div>
                    <label class="block text-sm font-medium mb-1" for="name">Your survey name</label>
                    <input id="name" class="form-input w-full" type="text" placeholder="" />
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1" for="description">Description</label>
                    <textarea id="description" class="form-input w-full" type="text" placeholder=""></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1" for="countAllowedSubmissions">Maximum number of
                        submissions</label>
                    <input id="countAllowedSubmissions" class="form-input w-full" type="text"
                        placeholder="Leave blank to set to 1" />
                </div>
            </x-survey-tab>
            <x-survey-tab title="rationale" icon="fa-brain">
                <div>
                    <label class="block text-sm font-medium mb-1" for="rationale_title">Title</label>
                    <input id="rationale_title" class="form-input w-full" type="text" placeholder="" />
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1" for="rationale_description">Description</label>
                    <textarea id="rationale_description" class="form-input w-full" type="text" placeholder=""></textarea>
                </div>

                <div x-data="{ option: '' }">
                    <label class="block text-sm font-medium mb-1" for="survey_type">Survey Type</label>
                    <select class="form-select w-full" id="survey_type" x-model="option">
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
                        <input id="manual_survey_type" class="form-input w-full my-2" type="text" placeholder="" />
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm font-medium mb-1" for="sub_specialization">Sub-specialization /
                            Target Focus</label>
                        <input id="sub_specialization" class="form-input w-full" type="text"
                            placeholder="This is optional, but would help our AI to analyze more." />
                    </div>
                </div>
            </x-survey-tab>
            <x-survey-tab title="respondents" icon="fa-users">
                <h1>hello</h1>
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
                <h1>hello</h1>
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
                <livewire:survey-creation-preview-screen />
            </div>
        </div>

    </div>
</div>
