<div x-data="{ modalOpen: true }" wire:key="{{ $question->id }}" x-init="$watch('modalOpen', value => $wire.modalClosed())">
    <!-- Modal backdrop -->
    <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak></div>
    <!-- Modal dialog -->
    <div id="option-modal" class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center px-4 sm:px-6"
        role="dialog" aria-modal="true" x-show="modalOpen" x-transition:enter="transition ease-in-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4" x-cloak>
        <div class="bg-white rounded shadow-lg overflow-auto max-w-3xl w-full max-h-full"
            @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
            <!-- Modal header -->
            <div class="px-5 py-3 border-slate-200">
                <div class="flex justify-between items-center">
                    <div class="font-semibold text-slate-800">
                        <span class="text-xl">Configure "{{ $question->content }}" Question</span>
                        <p id="helper-text-explanation" class="text-sm text-gray-500">{{ $question->formatted_type }}
                        </p>
                    </div>
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
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                        Question Name
                    </label>
                    <input
                        class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Question Name" wire:model="question.content"
                        wire:change="onContentChanged($event.target.value)" id="content">
                </div>
                <div class="flex items-center mb-4">
                    <input id="required" type="checkbox" wire:model="isRequired"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                    <label for="required" class="ml-2 text-sm font-medium text-gray-900">Required</label>
                </div>
                @if (
                    $question->type != 'date' &&
                        $question->type != 'time' &&
                        $question->type != 'radio' &&
                        $question->type != 'likert' &&
                        $question->type != 'range')
                    @if ($isRequired)
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="min">
                                Minimum Characters / Choices
                            </label>
                            <input
                                class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="number" placeholder="Leave blank to set to default" wire:model="min"
                                id="min">
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="max">
                            Maximum Characters / Choices
                        </label>
                        <input
                            class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="number" placeholder="Leave blank to set to default" wire:model="max" max="250"
                            id="max">
                    </div>
                @endif

                @if ($question->type == 'range')
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="min">
                            Minimum value
                        </label>
                        <input
                            class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="number" placeholder="Leave blank to set to default" wire:model="min" id="min">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="max">
                            Maximum value
                        </label>
                        <input
                            class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="number" placeholder="Leave blank to set to default" wire:model="max" max="250"
                            id="max">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="max">
                            Minimum value label
                        </label>
                        <input
                            class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Leave blank to set to default" wire:model="question.options.0"
                            wire:change="onChoiceChanged(0, $event.target.value)" max="250" id="minValue">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="max">
                            Maximum value label
                        </label>
                        <input
                            class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Leave blank to set to default"
                            wire:change="onChoiceChanged(1, $event.target.value)" wire:model="question.options.1"
                            max="250" id="maxValue">
                    </div>
                @endif

                @if ($question->type == 'radio')
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="new_choice">
                            Available Template Chooser
                        </label>
                        <select id="templateChooser" wire:model="templateChooser" class="form-select">
                            <option>Select a template to use</option>
                            <optgroup label="8-point Likert Scales">
                                <option value="8_truth">Truth Scale (False to True)</option>
                            </optgroup>
                            <optgroup label="5-point Likert Scales">
                                <option value="5_wellness">Wellness Scale</option>
                            </optgroup>
                            <optgroup label="4-point Likert Scales">
                                <option value="4_relevancy">Relevancy Scale</option>
                                <option value="4_appropriateness">Appropriateness Scale</option>
                                <option value="4_timeliness">Timeliness Scale</option>
                                <option value="4_knowledgeability">Knowledgeability Scale</option>
                                <option value="4_satisfaction">Satisfaction Scale</option>
                                <option value="4_excellency">Excellency Scale</option>
                                <option value="4_impact">Impact Scale</option>
                            </optgroup>
                            <optgroup label="3-point Likert Scales">
                                <option value="3_completeness">Completeness Scale</option>
                                <option value="3_tristate">Tristate Boolean (Yes/No/Neutral)</option>
                            </optgroup>
                        </select>
                    </div>
                @endif

                @if ($question->type == 'radio' || $question->type == 'multiselect')
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="new_choice">
                            Add a new choice
                        </label>
                        <input
                            class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Enter your new choice here" wire:model="newOptionName"
                            id="new_choice" wire:keydown.enter="createNewOption">
                        <p id="helper-text-explanation" class="text-sm text-gray-400">Press enter to add to the list
                            of
                            choices</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="new_choice">
                            Reverse Choices?
                        </label>
                        <button
                            class="flex-no-shrink p-2 ml-2 border rounded text-red border-indigo-600 hover:text-indigo-500 hover:bg-indigo"
                            wire:click="reverse">Reverse</button>
                    </div>

                    @foreach ($question->options as $index => $choice)
                        <div class="flex mb-4 items-center">
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
                                            {{ $choice }}
                                        </div>
                                        <span class="text-xs text-gray-600" id="passwordHelp">Click to update
                                            text</span>

                                    </div>
                                    <div x-show=isEditing class="flex flex-col">
                                        <input type="text"
                                            class="form-input w-full px-2 border border-gray-400 text-lg shadow-inner"
                                            x-ref="textInput" wire:model.lazy="question.options.{{ $index }}"
                                            wire:change="onChoiceChanged({{ $index }}, $event.target.value)"
                                            x-on:keydown.enter="isEditing = false" x-on:blur="isEditing = false" />
                                    </div>
                                </div>
                            </div>

                            <button
                                class="flex-no-shrink p-2 ml-2 border rounded text-red border-red-600 hover:text-indigo-500 hover:bg-red"
                                wire:click="deleteOption({{ $index }})">Remove</button>
                        </div>
                    @endforeach

                @endif

            </div>
        </div>
    </div>
</div>
