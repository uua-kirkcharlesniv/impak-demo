<div x-data="{ modalOpen: false }">
    <button @click.prevent="modalOpen = true"
        class="w-full mt-4 py-2 px-4
        bg-gray-50 border border-gray-300 hover:bg-gray-100 focus:ring-gray-500 focus:ring-offset-gray-300
        text-gray-700 transition ease-in duration-200 text-center text-base font-medium focus:outline-none focus:ring-2
        focus:ring-offset-2 rounded-lg flex items-center hover:no-underline"><span
            class="no-underline mx-auto"><svg viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4 text-nt-blue inline mr-1 -mt-1">
                <path d="M7.00001 1.1665V12.8332M1.16667 6.99984H12.8333" stroke="currentColor" stroke-width="1.67"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg> Add form field </span>
        <!---->
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
                            <div class="mx-auto py-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7">
                                    </path>
                                </svg></div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Short Answer
                            </p>
                        </div>
                        <div role="button" class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col"
                            @click="modalOpen = false" wire:click="pick('long-answer')">
                            <div class="mx-auto py-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7">
                                    </path>
                                </svg></div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Long Answer
                            </p>
                        </div>
                        <div @click="modalOpen = false" wire:click="pick('date')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto py-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7">
                                    </path>
                                </svg></div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Date
                            </p>
                        </div>
                        <div @click="modalOpen = false" wire:click="pick('time')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto py-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7">
                                    </path>
                                </svg></div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Time
                            </p>
                        </div>
                    </div>
                    <p class="text-gray-500 uppercase text-xs font-semibold mt-8">Choices</p>
                    <div class="grid grid-cols-4 gap-4 mt-2">
                        <div @click="modalOpen = false" wire:click="pick('checkbox')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto py-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7">
                                    </path>
                                </svg></div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Multiple Choice (Checkbox)
                            </p>
                        </div>
                        <div @click="modalOpen = false" wire:click="pick('radio')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto py-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7">
                                    </path>
                                </svg></div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Single Choice (Radio)
                            </p>
                        </div>
                        <div @click="modalOpen = false" wire:click="pick('likert')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto py-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7">
                                    </path>
                                </svg></div>
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
                    <p class="text-gray-500 uppercase text-xs font-semibold mt-8">File Uploads</p>
                    <div class="grid grid-cols-4 gap-4 mt-2">
                        <div @click="modalOpen = false" wire:click="pick('photo')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto py-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7">
                                    </path>
                                </svg></div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Photo Upload
                            </p>
                        </div>

                        <div @click="modalOpen = false" wire:click="pick('document')" role="button"
                            class="bg-gray-50 border hover:bg-gray-100 rounded-md p-2 flex flex-col">
                            <div class="mx-auto py-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7">
                                    </path>
                                </svg></div>
                            <p class="w-full text-xs text-gray-500 uppercase text-center font-semibold mb-4">
                                Document Upload
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
