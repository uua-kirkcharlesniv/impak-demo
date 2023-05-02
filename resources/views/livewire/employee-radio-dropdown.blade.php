<div>
    <div class="relative inline-flex w-full" x-data="{ open: false, selected: {{ $selectedUserId }} }">
        <button
            class="btn w-full justify-between min-w-44 bg-white border-slate-200 hover:border-slate-300 text-slate-500 hover:text-slate-600"
            aria-label="Select date range" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
            <span class="flex items-center">
                <span>{{ $selectedText }}</span>
            </span>
            <svg class="shrink-0 ml-1 fill-current text-slate-400" width="11" height="7" viewBox="0 0 11 7">
                <path d="M5.4 6.8L0 1.4 1.4 0l4 4 4-4 1.4 1.4z" />
            </svg>
        </button>
        <div class="z-10 absolute top-full left-0 w-full bg-white border border-slate-200 py-1.5 rounded shadow-lg overflow-hidden mt-1"
            @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
            x-transition:enter="transition ease-out duration-100 transform"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" x-cloak>
            <div class="font-medium text-sm text-slate-600 divide-y divide-slate-200" x-ref="options">
                @foreach ($users as $user)
                    <button tabindex="{{ $user->id }}"
                        class="flex items-center justify-between w-full hover:bg-slate-50 py-2 px-3 cursor-pointer"
                        :class="{{ $selectedUserId }} == {{ $user->id }} && 'text-indigo-500'"
                        wire:click.prevent="selectUser({{ $user->id }})"
                        @click="open = false"
                        @focus="open = true"
                        @focusout="open = false">
                        <span>{{ $user->name }}
                        </span>
                        <svg class="shrink-0 ml-2 fill-current text-indigo-400"
                            :class="{{ $selectedUserId }} !== {{ $user->id }} && 'invisible'" width="12" height="9"
                            viewBox="0 0 12 9">
                            <path
                                d="M10.28.28L3.989 6.575 1.695 4.28A1 1 0 00.28 5.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28.28z" />
                        </svg>
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</div>
