<div>
    <div class="relative inline-flex w-full" x-data="{ open: false, selected: 0 }">
        <button
            class="btn w-full justify-between min-w-44 bg-white border-slate-200 hover:border-slate-300 text-slate-500 hover:text-slate-600"
            aria-label="Select date range" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
            <span class="flex items-center">
                <span>Jane Doe, John Doe, et al.</span>
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
                <ul class="mb-4">
                    @for ($i = 0; $i < rand(5, 20); $i++)
                        <li class="py-3 px-3">
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox" {{ $i % 2 == 0 ? 'checked' : '' }} />
                                <img class="ml-4 rounded-full w-8 h-8" src="https://picsum.photos/{{$i + 120}}" alt="Dominik McNeail">
                                <span class="text-sm font-medium ml-2">{{ fake()->name() }}</span>
                            </label>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
</div>
