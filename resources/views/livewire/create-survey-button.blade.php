<div x-data="{ modalOpen: false }">
    <button @click.prevent="modalOpen = true" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
            <path
                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
        </svg>
        <span class="hidden xs:block ml-2">Create Survey</span>
    </button>
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
                                @if ($tab == 'select')
                                    <path fill-rule="evenodd"
                                        d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z"
                                        clip-rule="evenodd"></path>
                                @else
                                    <path fill-rule="evenodd"
                                        d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z"
                                        clip-rule="evenodd"></path>
                                @endif
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 w-full">
                        <h2 class="text-2xl font-semibold text-center text-gray-900">
                            @if ($tab == 'select')
                                Choose a base for your form
                            @else
                                Impak AI-powered Form Generator
                            @endif
                        </h2>
                    </div>
                </div>
                <div class="mt-2 w-full">
                    @if ($tab == 'select')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                            <div
                                class="rounded-md border p-4 flex flex-col items-center cursor-pointer hover:bg-gray-50 relative">
                                <div class="p-4"><i
                                        class="fa-regular fa-face-grin-stars w-8 text-blue-500 fa-2xl"></i>
                                </div>
                                <p class="font-medium">Start from a blank form</p>
                                <a href="{{ route('survey.create') }}" class="absolute inset-0"></a>
                            </div>
                            <div
                            wire:click.prevent="$set('tab', 'create')"
                                class="rounded-md border p-4 flex flex-col items-center cursor-pointer hover:bg-gray-50">
                                <div class="p-4 relative"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor" class="w-8 h-8 text-blue-500">
                                        <path fill-rule="evenodd"
                                            d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z"
                                            clip-rule="evenodd"></path>
                                    </svg></div>
                                <p class="font-medium text-indigo-600">Use our AI to create the form</p><span
                                    class="text-xs text-gray-500">(1 min)</span>
                            </div>
                            <div
                                class="rounded-md border p-4 flex flex-col items-center cursor-pointer hover:bg-gray-50 relative">
                                <div class="p-4 relative"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor" class="w-8 h-8 text-blue-500">
                                        <path
                                            d="M11.25 5.337c0-.355-.186-.676-.401-.959a1.647 1.647 0 01-.349-1.003c0-1.036 1.007-1.875 2.25-1.875S15 2.34 15 3.375c0 .369-.128.713-.349 1.003-.215.283-.401.604-.401.959 0 .332.278.598.61.578 1.91-.114 3.79-.342 5.632-.676a.75.75 0 01.878.645 49.17 49.17 0 01.376 5.452.657.657 0 01-.66.664c-.354 0-.675-.186-.958-.401a1.647 1.647 0 00-1.003-.349c-1.035 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401.31 0 .557.262.534.571a48.774 48.774 0 01-.595 4.845.75.75 0 01-.61.61c-1.82.317-3.673.533-5.555.642a.58.58 0 01-.611-.581c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.035-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959a.641.641 0 01-.658.643 49.118 49.118 0 01-4.708-.36.75.75 0 01-.645-.878c.293-1.614.504-3.257.629-4.924A.53.53 0 005.337 15c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.036 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.369 0 .713.128 1.003.349.283.215.604.401.959.401a.656.656 0 00.659-.663 47.703 47.703 0 00-.31-4.82.75.75 0 01.83-.832c1.343.155 2.703.254 4.077.294a.64.64 0 00.657-.642z">
                                        </path>
                                    </svg></div>
                                <p class="font-medium">Choose from our pre-defined frameworks</p>
                                <a href="/frameworks" class="absolute inset-0"></a>
                            </div>
                            <div
                                class="rounded-md border p-4 flex flex-col items-center cursor-pointer hover:bg-gray-50 relative">
                                <div class="p-4 relative"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor" class="w-8 h-8 text-blue-500">
                                        <path
                                            d="M11.25 5.337c0-.355-.186-.676-.401-.959a1.647 1.647 0 01-.349-1.003c0-1.036 1.007-1.875 2.25-1.875S15 2.34 15 3.375c0 .369-.128.713-.349 1.003-.215.283-.401.604-.401.959 0 .332.278.598.61.578 1.91-.114 3.79-.342 5.632-.676a.75.75 0 01.878.645 49.17 49.17 0 01.376 5.452.657.657 0 01-.66.664c-.354 0-.675-.186-.958-.401a1.647 1.647 0 00-1.003-.349c-1.035 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401.31 0 .557.262.534.571a48.774 48.774 0 01-.595 4.845.75.75 0 01-.61.61c-1.82.317-3.673.533-5.555.642a.58.58 0 01-.611-.581c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.035-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959a.641.641 0 01-.658.643 49.118 49.118 0 01-4.708-.36.75.75 0 01-.645-.878c.293-1.614.504-3.257.629-4.924A.53.53 0 005.337 15c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.036 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.369 0 .713.128 1.003.349.283.215.604.401.959.401a.656.656 0 00.659-.663 47.703 47.703 0 00-.31-4.82.75.75 0 01.83-.832c1.343.155 2.703.254 4.077.294a.64.64 0 00.657-.642z">
                                        </path>
                                    </svg></div>
                                <p class="font-medium text-center">Start a target research from our sub-frameworks</p><a
                                    href="/subframeworks" class="absolute inset-0"></a>
                            </div>
                        </div>
                    @else
                        <div class="mt-4">
                            <label class="block text-sm font-medium mb-1" for="description">Describe your form to us
                                🤔</label>
                            <textarea id="description" class="form-input w-full" type="text"
                                placeholder="I want a contact us form, with their name, email, and message box for their concerns."></textarea>
                        </div>
                        <button class="w-full mt-4 btn bg-indigo-500 hover:bg-indigo-600 text-white"
                            @click.prevent="modalOpen = true" aria-controls="feedback-modal">
                            <span class="hidden xs:block ml-2">
                                Start Generating
                            </span>
                        </button>
                        <button class="w-full mt-2 bg-white text-indigo-500 text-xs"
                            @click.prevent="modalOpen = true" aria-controls="feedback-modal" wire:click.prevent="$set('tab', 'select')">
                            <span class="hidden xs:block ml-2">
                                I want to try later
                            </span>
                        </button>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
