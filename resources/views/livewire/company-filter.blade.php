<div>
    <div class="relative inline-flex" x-data="{ open: false }">
        <button class="btn bg-white border-slate-200 hover:border-slate-300 text-slate-500 hover:text-slate-600"
            aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
            <span class="sr-only">Filter</span><wbr>
            <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                <path
                    d="M9 15H7a1 1 0 010-2h2a1 1 0 010 2zM11 11H5a1 1 0 010-2h6a1 1 0 010 2zM13 7H3a1 1 0 010-2h10a1 1 0 010 2zM15 3H1a1 1 0 010-2h14a1 1 0 010 2z" />
            </svg>
        </button>
        <div class="origin-top-right z-10 absolute top-full min-w-56 bg-white border border-slate-200 pt-1.5 rounded shadow-lg overflow-hidden mt-1 right-0"
            @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" x-cloak>
            <div class="text-xs font-semibold text-slate-400 uppercase pt-1.5 pb-2 px-4">Filters</div>
            <ul class="mb-4">
                <li class="py-1 px-3">
                    <label class="flex items-center">
                        <input type="radio" class="form-radio" value="company" name="company-filter-radio"
                            wire:model="radioSelected" checked />
                        <span class="text-sm font-medium ml-2">Company</span>
                    </label>
                </li>
                <li class="py-1 px-3">
                    <label class="flex items-center">
                        <input type="radio" class="form-radio" value="group" name="company-filter-radio"
                            wire:model="radioSelected" />
                        <span class="text-sm font-medium ml-2">Group</span>
                    </label>
                </li>
                <li class="py-1 px-3">
                    <label class="flex items-center">
                        <input type="radio" class="form-radio" value="department"name="company-filter-radio"
                            wire:model="radioSelected" />
                        <span class="text-sm font-medium ml-2">Department</span>
                    </label>
                </li>
                <li class="py-1 px-3">
                    <label class="flex items-center">
                        <input type="radio" class="form-radio" value="employee"name="company-filter-radio"
                            wire:model="radioSelected" />
                        <span class="text-sm font-medium ml-2">Employee</span>
                    </label>
                </li>
            </ul>
            <div class="py-2 px-3 border-t border-slate-200 bg-slate-50">
                <ul class="flex items-center justify-between">
                    <li>
                        <button
                            class="btn-xs bg-white border-slate-200 hover:border-slate-300 text-slate-500 hover:text-slate-600">Clear</button>
                    </li>
                    <li>
                        <button class="btn-xs bg-indigo-500 hover:bg-indigo-600 text-white" @click="open = false"
                            wire:click="applyFilter" @focusout="open = false">Apply</button>
                    </li>
                </ul>
            </div>
        </div>
        @if ($filterApplied != 'company')
            <div class="w-80">
                <div class="relative inline-flex w-full" x-data="{ open: false, selected: 0 }">
                    <button
                        class="btn w-full justify-between min-w-44 bg-white border-slate-200 hover:border-slate-300 text-slate-500 hover:text-slate-600"
                        aria-label="Select date range" aria-haspopup="true" @click.prevent="open = !open"
                        :aria-expanded="open">
                        <span class="flex items-center">
                            <span>{{ $nameSelected }}</span>
                        </span>
                        <svg class="shrink-0 ml-1 fill-current text-slate-400" width="11" height="7"
                            viewBox="0 0 11 7">
                            <path d="M5.4 6.8L0 1.4 1.4 0l4 4 4-4 1.4 1.4z" />
                        </svg>
                    </button>
                    <div class="z-10 absolute top-full left-0 w-full bg-white border border-slate-200 py-1.5 rounded shadow-lg overflow-hidden mt-1"
                        @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
                        x-transition:enter="transition ease-out duration-100 transform"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" x-cloak>
                        <div class="font-medium text-sm text-slate-600 divide-y divide-slate-200" x-ref="options">
                            @foreach ($data as $id => $name)
                                <button tabindex="{{ $id }}"
                                    class="flex items-center justify-between w-full hover:bg-slate-50 py-2 px-3 cursor-pointer"
                                    :class="selected === {{ $id }} && 'text-indigo-500'"
                                    @click="selected = {{ $id }};open = false" @focus="open = true"
                                    wire:click="changeId('{{ $id }}', '{{ $name }}')"
                                    @focusout="open = false">
                                    <span>{{ $name }}</span>
                                    <svg class="shrink-0 ml-2 fill-current text-indigo-400"
                                        :class="selected !== {{ $id }} && 'invisible'" width="12"
                                        height="9" viewBox="0 0 12 9">
                                        <path
                                            d="M10.28.28L3.989 6.575 1.695 4.28A1 1 0 00.28 5.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28.28z" />
                                    </svg>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

</div>
