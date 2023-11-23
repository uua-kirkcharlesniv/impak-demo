<div>
    <div class="relative inline-flex w-full" x-data="{ open: false, selected: 0 }">
        <button
            class="btn w-full justify-between min-w-44 bg-white border-slate-200 hover:border-slate-300 text-slate-500 hover:text-slate-600"
            aria-label="Select date range" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
            <span class="flex items-center">
                <span>{{ $text }}</span>
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
                @foreach ($departments as $department)
                    <button tabindex="{{ $department->id }}"
                        class="flex items-center justify-between w-full hover:bg-slate-50 py-2 px-3 cursor-pointer"
                        :class="{{ $selectedDepartmentId ?? -1 }} == {{ $department->id }} && 'text-indigo-500'"
                        wire:click.prevent="selectDepartment({{ $department->id }})" @click="open = false"
                        @focus="open = true" @focusout="open = false">
                        <span>{{ $department->name }}</span>
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</div>
