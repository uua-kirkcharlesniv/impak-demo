<div wire:ignore>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1" for="normal">Open the form on</label>
            <div>
                <!-- Start -->
                <div class="relative w-full">
                    <input wire:change="onStartDateChanged($event.target.value)" wire:model="survey.start_date"
                        class="w-full datepicker form-input pl-9 text-slate-500 hover:text-slate-600 font-medium focus:border-slate-300 w-160"
                        placeholder="Select date" />
                    <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                        <svg class="w-4 h-4 fill-current text-slate-500 ml-3" viewBox="0 0 16 16">
                            <path
                                d="M15 2h-2V0h-2v2H9V0H7v2H5V0H3v2H1a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V3a1 1 0 00-1-1zm-1 12H2V6h12v8z" />
                        </svg>
                    </div>
                </div>

                <!-- End -->
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1" for="normal">Close the form on</label>
            <div>
                <!-- Start -->
                <div class="relative w-full" wire:ignore>
                    <input wire:change="onEndDateChanged($event.target.value)" wire:model="survey.end_date"
                        class="w-full datepicker form-input pl-9 text-slate-500 hover:text-slate-600 font-medium focus:border-slate-300 w-160"
                        placeholder="Select date" />
                    <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                        <svg class="w-4 h-4 fill-current text-slate-500 ml-3" viewBox="0 0 16 16">
                            <path
                                d="M15 2h-2V0h-2v2H9V0H7v2H5V0H3v2H1a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V3a1 1 0 00-1-1zm-1 12H2V6h12v8z" />
                        </svg>
                    </div>
                </div>

                <!-- End -->
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1" for="normal">Start time</label>
                <div class="relative w-full">
                    <input wire:change="onStartTimeChanged($event.target.value)" wire:model="survey.start_time"
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
                    <input wire:change="onEndTimeChanged($event.target.value)" wire:model="survey.end_time"
                        class="w-full timepicker form-input pl-9 text-slate-500 hover:text-slate-600 font-medium focus:border-slate-300 w-160"
                        placeholder="Select time" />
                    <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                        <i class="fa-solid fa-clock w-4 h-4 fill-current text-slate-500 ml-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="mt-4">
        <label class="block text-sm font-medium mb-1" for="normal">Set the form recurring on every:
        </label>
        <div class="grid grid-cols-3">
            <div>
                <label class="inline-flex items-center">
                    <input wire:model="recurrent_days" type="checkbox" class="form-checkbox text-indigo-600"
                        value="1">
                    <span class="ml-2">Monday</span>
                </label>
            </div>
            <div>
                <label class="inline-flex items-center">
                    <input wire:model="recurrent_days" type="checkbox" class="form-checkbox text-indigo-600"
                        value="2">
                    <span class="ml-2">Tuesday</span>
                </label>
            </div>
            <div>
                <label class="inline-flex items-center">
                    <input wire:model="recurrent_days" type="checkbox" class="form-checkbox text-indigo-600"
                        value="3">
                    <span class="ml-2">Wednesday</span>
                </label>
            </div>
            <div>
                <label class="inline-flex items-center">
                    <input wire:model="recurrent_days" type="checkbox" class="form-checkbox text-indigo-600"
                        value="4">
                    <span class="ml-2">Thursday</span>
                </label>
            </div>
            <div>
                <label class="inline-flex items-center">
                    <input wire:model="recurrent_days" type="checkbox" class="form-checkbox text-indigo-600"
                        value="5">
                    <span class="ml-2">Friday</span>
                </label>
            </div>
            <div>
                <label class="inline-flex items-center">
                    <input wire:model="recurrent_days" type="checkbox" class="form-checkbox text-indigo-600"
                        value="6">
                    <span class="ml-2">Saturday</span>
                </label>
            </div>
            <div>
                <label class="inline-flex items-center">
                    <input wire:model="recurrent_days" type="checkbox" class="form-checkbox text-indigo-600"
                        value="0">
                    <span class="ml-2">Sunday</span>
                </label>
            </div>
        </div>
    </div> --}}
</div>
