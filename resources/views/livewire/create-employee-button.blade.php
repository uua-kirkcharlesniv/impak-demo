<div>
    @if (Auth::user()->hasPermissionTo('manage-employees'))
        <div x-data="{ modalOpen: {{ Auth::user()->is_employee_onboarded == false &&auth()->user()->can('manage-employees')? 'true': 'false' }} }">
            @if (isset($minimalist) && $minimalist)
                <button @click.prevent="modalOpen = true"
                    class="p-1.5 shrink-0 rounded border border-slate-200 hover:border-slate-300 shadow-sm ml-2">
                    <svg class="w-4 h-4 fill-current text-indigo-500" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1Z" />
                    </svg>
                </button>
            @else
                <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" @click.prevent="modalOpen = true"
                    aria-controls="feedback-modal">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                        <path
                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span class="hidden xs:block ml-2">
                        Create Employee
                    </span>
                </button>
            @endif

            <!-- Modal backdrop -->
            <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak>
            </div>
            <!-- Modal dialog -->
            <div id="feedback-modal"
                class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center px-4 sm:px-6"
                role="dialog" aria-modal="true" x-show="modalOpen"
                x-transition:enter="transition ease-in-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in-out duration-200"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
                x-cloak>
                <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full"
                    @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                    <!-- Modal header -->
                    <div class="px-5 py-3 border-b border-slate-200">
                        <div class="flex justify-between items-center">
                            <div class="font-semibold text-slate-800">New Employee</div>
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
                        <nav class="flex border-b border-gray-100 text-sm font-medium mb-5">
                            <button wire:click="$set('tab', 'create')"
                                class="-mb-px border-b {{ $tab == 'create' ? 'border-current text-cyan-500' : 'border-transparent hover:text-cyan-500' }} p-4">
                                Create
                            </button>

                            <button wire:click="$set('tab', 'import')"
                                class="-mb-px border-b {{ $tab == 'import' ? 'border-current text-cyan-500' : 'border-transparent hover:text-cyan-500' }} p-4">
                                Import
                            </button>

                        </nav>
                        @if ($tab == 'create')
                            <form wire:submit.prevent="submit">
                                <div class="text-sm">
                                    <div class="font-medium text-slate-800 mb-3">Add a new member to your family 🙌
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex">
                                        <div class="flex-auto">
                                            <label class="block text-sm font-medium mb-1" for="first_name">First
                                                Name<span class="text-rose-500">*</span></label>
                                            <input id="first_name" class="form-input w-full px-2 py-1" type="text"
                                                required wire:model="first_name" />
                                            @error('first_name')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        &nbsp;
                                        <div class="flex-auto">
                                            <label class="block text-sm font-medium mb-1" for="middle_name">Middle
                                                Name</label>
                                            <input id="middle_name" class="form-input w-full px-2 py-1" type="text"
                                                wire:model="middle_name" />
                                            @error('middle_name')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        &nbsp;
                                        <div class="flex-auto">
                                            <label class="block text-sm font-medium mb-1" for="last_name">Last Name<span
                                                    class="text-rose-500">*</span></label>
                                            <input id="last_name" class="form-input w-full px-2 py-1" type="text"
                                                required wire:model="last_name" />
                                            @error('last_name')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="gender">Gender</label>
                                        <select id="gender"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            wire:model="gender" required>
                                            <option selected value="M">Male</option>
                                            <option value="F">Female</option>
                                            <option value="NA">I prefer not to say</option>
                                        </select>
                                        @error('gender')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="dob">Date of
                                            Birth</label>
                                        <input id="dob" class="form-input w-full px-2 py-1" type="date"
                                            wire:model="dob" />
                                        @error('dob')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="date_of_hire">Date of
                                            Hire</label>
                                        <input id="date_of_hire" class="form-input w-full px-2 py-1" type="date"
                                            wire:model="date_of_hire" required />
                                        @error('date_of_hire')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="flex">
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium mb-1" for="country">Country<span
                                                    class="text-rose-500">*</span></label>
                                            <select id="country"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                wire:model="country">
                                                @foreach (\App\Enums\Countries::asSelectArray() as $key => $value)
                                                    <option value="{{ $key }}">{{ $key }}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        &nbsp;
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium mb-1" for="work_model">City /
                                                State<span class="text-rose-500">*</span></label>
                                            <input type="text" class="form-input" placeholder="City"
                                                wire:model="city" />

                                            @error('city')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="flex-auto">
                                            <label class="block text-sm font-medium mb-1" for="contract_type">Working
                                                Status<span class="text-rose-500">*</span></label>
                                            <select id="contract_type"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                wire:model="contract_type">
                                                @foreach (\App\Enums\EmployeeContractType::asSelectArray() as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('contract_type')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        &nbsp;
                                        <div class="flex-auto">
                                            <label class="block text-sm font-medium mb-1" for="work_model">Work
                                                Model<span class="text-rose-500">*</span></label>
                                            <select id="work_model"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                wire:model="work_model">
                                                @foreach (\App\Enums\WorkModel::asSelectArray() as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @error('work_model')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="position">Position</label>
                                        <input id="position" class="form-input w-full px-2 py-1" type="text"
                                            required wire:model="position" />
                                        @error('position')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="flex">
                                        <div>
                                            <label class="block text-sm font-medium mb-1"
                                                for="nationality">Nationality</label>
                                            <input id="nationality" class="form-input w-full px-2 py-2.5"
                                                type="text" required wire:model="nationality" />
                                            @error('nationality')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        &nbsp;
                                        <div class="flex-auto">
                                            <label class="block text-sm font-medium mb-1" for="civil_status">Civil
                                                Status</label>
                                            <select id="civil_status"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                wire:model="civil_status">
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Separated">Separated</option>
                                                <option value="Widowed">Widowed</option>
                                            </select>
                                            @error('civil_status')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1"
                                            for="highest_educational_attainment">Highest Educational Attainment</label>
                                        <select id="highest_educational_attainment"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            wire:model="highest_educational_attainment">
                                            <option value="HS">High-School</option>
                                            <option value="SHS">Senior High-School</option>
                                            <option value="UG">Undergraduate</option>
                                            <option value="G">Graduate</option>
                                            <option value="D">Doctoral</option>
                                        </select>
                                        @error('highest_educational_attainment')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="email">Email<span
                                                class="text-rose-500">*</span></label>
                                        <input id="email" class="form-input w-full px-2 py-1" type="email"
                                            required wire:model="email" />
                                        @error('email')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1" for="phone">Phone<span
                                                class="text-rose-500">*</span></label>
                                        <input id="phone" class="form-input w-full px-2 py-1" type="phone"
                                            required wire:model="phone" />
                                        @error('phone')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="grid gap-6 md:grid-cols-2">
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Department</label>
                                            <livewire:department-dropdown />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Group</label>
                                            <livewire:group-dropdown />
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class=" py-4 border-t border-slate-200">
                                    <div class="flex flex-wrap justify-end space-x-2">
                                        <button class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600"
                                            @click="modalOpen = false">Not now</button>
                                        <button class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">Add
                                            New</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <livewire:file-upload />
                        @endif
                    </div>

                </div>

            </div>
        </div>
    @endif
</div>
