<div>
    @if ($showButton == true && Auth::user()->hasPermissionTo('manage-employees'))
        <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white" @click.prevent="inviteModalOpen = true"
            aria-controls="feedback-modal">
            <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                <path
                    d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
            </svg>
            <span class="hidden xs:block ml-2">
                Invite
            </span>
        </button>
    @endif

    <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity" x-show="inviteModalOpen"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak>
    </div>
    <!-- Modal dialog -->
    <div id="feedback-modal"
        class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center px-4 sm:px-6" role="dialog"
        aria-modal="true" x-show="inviteModalOpen" x-transition:enter="transition ease-in-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4" x-cloak>
        <div class="bg-white rounded shadow-lg overflow-auto max-w-2xl w-full max-h-full">
            <!-- Modal header -->
            <div class="px-5 py-3 border-b border-slate-200">
                <div class="flex justify-between items-center">
                    <div class="font-semibold text-slate-800">Invite new employees</div>
                    <button class="text-slate-400 hover:text-slate-500" @click="inviteModalOpen = false">
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
                <form wire:submit.prevent="submit">

                    <div class="space-y-3 mb-4">
                        @foreach ($invites as $index => $invite)
                            <div class="flex gap-4 items-center">
                                <div class="flex-3">
                                    <label class="block text-sm font-medium mb-1" for="email">Email<span
                                            class="text-rose-500">*</span></label>
                                    <input class="form-input w-full px-2 py-1" type="email" required
                                        wire:model="invites.{{ $index }}.email" />
                                    @error('invites.' . $index . '.email')
                                        <span class="text-red-500 my-2 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="flex-auto">
                                    <label class="block text-sm font-medium mb-1" for="first_name">First
                                        Name<span class="text-rose-500">*</span></label>
                                    <input class="form-input w-full px-2 py-1" type="text" required
                                        wire:model="invites.{{ $index }}.first_name" />

                                    @error('invites.' . $index . '.first_name')
                                        <span class="text-red-500 my-2 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="flex-auto">
                                    <label class="block text-sm font-medium mb-1" for="last_name">Last Name<span
                                            class="text-rose-500">*</span></label>
                                    <input class="form-input w-full px-2 py-1" type="text" required
                                        wire:model="invites.{{ $index }}.last_name" />

                                    @error('invites.' . $index . '.last_name')
                                        <span class="text-red-500 my-2 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if (count($invites) > 1 && !$loop->first)
                                    <a wire:ignore wire:click.prevent="removeInvite({{ $index }})"
                                        class="font-black p-2 text-red-600 text-lg cursor-pointer drop-shadow-lg rounded-lg"><i
                                            class="fa-solid fa-trash"></i></a>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class=" py-4 border-t border-slate-200">
                        <div class="flex flex-wrap justify-end space-x-2">
                            <a wire:ignore wire:click.prevent="addInvite"
                                class="btn-sm bg-white shadow-md cursor-pointer hover:bg-slate-300 text-black">Add
                                New</a>
                            <button type="submit" wire:submit="submit"
                                class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">Invite</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
