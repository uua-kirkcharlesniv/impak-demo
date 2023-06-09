<div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h5 class="text-2xl font-bold tracking-tight text-gray-900">Employee Demographics</h5>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Department</h6>
        <!-- Form -->
        <form>
            <div class="space-y-3">
                <x-forms.multiple-choice name="Production" />
                <x-forms.multiple-choice name="Maintenance" />
                <x-forms.multiple-choice name="Warehouse / Shipping" />
                <x-forms.multiple-choice name="QA / QC" />
                <x-forms.multiple-choice name="QA Purchasing" />
                <x-forms.multiple-choice name="Operations" />
            </div>
        </form>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Position Level</h6>
        <!-- Form -->
        <form>
            <div class="space-y-3">
                <x-forms.multiple-choice name="Rank and File Employee / Individual Contributor" />
                <x-forms.multiple-choice name="Team Lead / Supervisor / Manager" />
                <x-forms.multiple-choice name="Department Head" />
            </div>
        </form>
    </div>
    <div class="mb-8 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Length of service</h6>
        <!-- Form -->
        <form>
            <div class="space-y-3">
                <x-forms.multiple-choice name="0 - 1 year" />
                <x-forms.multiple-choice name="2 - 4 year" />
                <x-forms.multiple-choice name="5 - 7 year" />
                <x-forms.multiple-choice name="8 years and more" />
            </div>
        </form>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h5 class="text-2xl font-bold tracking-tight text-gray-900">Alignment with Organization Goals</h5>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Do you have a clear understanding of what is
            expected of you in your job?</h6>
        <!-- Form -->
        <form>
            <x-forms.likert-scale />
        </form>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Do you feel qualified to handle your current
            job?</h6>
        <!-- Form -->
        <form>
            <x-forms.likert-scale />
        </form>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">What will help you in performing better at your
            current job?</h6>
        <p class="text-sm text-slate-400 mb-6"><span class="text-indigo-500">Please choose your top 3 priorities.</span>
        </p>

        <!-- Form -->
        <form>
            <div class="space-y-3 mb-8">
                <x-forms.checkbox name="Clear organization goals" />
                <x-forms.checkbox name="Improved job systems and processes" />
                <x-forms.checkbox name="Supportive manager" />
                <x-forms.checkbox name="Monetary job rewards" />
                <x-forms.checkbox name="Better relationship with colleagues" />
                <x-forms.checkbox name="Better physical working conditions" />
            </div>
        </form>
    </div>
    <div class="mb-8 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">What will hinder you from performing better at
            your current job?</h6>
        <form>
            <div>
                <textarea id="normal" class="form-input w-full" type="text" placeholder="Tell us what's on your mind 🤔"></textarea>
            </div>
        </form>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h5 class="text-2xl font-bold tracking-tight text-gray-900">Knowledge and Skills Capacity</h5>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Rate these factors according to how you feel
            about your skill to job level.</h6>
        <!-- Form -->
        <form>
            <div class="grid grid-cols-5 gap-4">
                <!-- Column headers -->
                <div></div>
                <div class="font-bold text-center">Highly unprepared</div>
                <div class="font-bold text-center">Unprepared</div>
                <div class="font-bold text-center">Prepared</div>
                <div class="font-bold text-center">Highly prepared</div>

                <!-- Row 1 -->
                <div class="font-bold">Interpersonal communication</div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row1"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row1"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row1"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row1"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>

                <!-- Row 2 -->
                <div class="font-bold">Written communication</div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row2"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row2"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row2"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row2"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>

                <!-- Row 3 -->
                <div class="font-bold">Public speaking</div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row3"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row3"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row3"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row3"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>

                <!-- Row 4 -->
                <div class="font-bold">Team management - leadership</div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row4"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row4"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row4"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row4"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>

                <!-- Row 5 -->
                <div class="font-bold">Organizational capabilities</div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row5"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row5"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row5"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row5"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>

                <!-- Row 6 -->
                <div class="font-bold">Agility</div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row6"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row6"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row6"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row6"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>

                <!-- Row 7 -->
                <div class="font-bold">Innovation</div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row7"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row7"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row7"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-center justify-center">
                    <input type="radio" name="row7"
                        class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
            </div>
        </form>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Do you think that the support you've received
            (like trainings and coaching sessions from your manager) helped you in the doing your job well?</h6>
        <!-- Form -->
        <form>
            <x-forms.likert-scale />
        </form>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Are you receiving coaching sessions from your
            manager?</h6>
        <!-- Form -->
        <form>
            <x-forms.tristate-boolean />
        </form>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Do you have training policies in place?</h6>
        <!-- Form -->
        <form>
            <x-forms.tristate-boolean />
        </form>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">When was the last time you received any kind of
            trainings?</h6>
        <!-- Form -->
        <form>
            <div class="space-y-3 mb-8">
                <x-forms.multiple-choice name="Within 0 - 6 months" />
                <x-forms.multiple-choice name="Within a year" />
                <x-forms.multiple-choice name="Within 2 years" />
                <x-forms.multiple-choice name="Others" />
            </div>
        </form>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Do you think that the support you've received
            (like trainings and coaching sessions from your manager) helped you in the doing your job well?</h6>
        <!-- Form -->
        <form>
            <x-forms.likert-scale />
        </form>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Are you satisfied with the current training
            that
            you are receiving?</h6>
        <!-- Form -->
        <form>
            <x-forms.likert-scale />
        </form>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">What kind of training will you prefer?</h6>
        <!-- Form -->
        <form>
            <div class="space-y-3 mb-8">
                <x-forms.multiple-choice name="Online" helper="via Zoom, Google Meet, et cetera" />
                <x-forms.multiple-choice name="Face to face interaction" helper="" />
                <x-forms.multiple-choice name="Hybrid" helper="Combined online and face to face interactions" />
                <x-forms.multiple-choice name="Self-paced training" helper="Learning in own time and schedule" />
            </div>
        </form>
    </div>
    <div class="mb-2 w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h6 class="mb-2 text-xl font-bold tracking-tight text-gray-900">What may hinder you from attending training
            programs?</h6>
        <!-- Form -->
        <form>
            <div>
                <input id="normal" class="form-input w-full" type="text"
                    placeholder="Tell us what's on your mind 🤔" />
            </div>
        </form>
    </div>

    <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" wire:click="$emitUp('updateParentScreen', 'completed')"
            aria-controls="feedback-modal">
        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
            <path
                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
        </svg>
        <span class="hidden xs:block ml-2">
            Publish
        </span>
    </button>
</div>
