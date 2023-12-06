<div class="col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200">
    <div class="flex flex-col h-full">
        <!-- Card top -->
        <div class="grow p-5">
            <!-- Menu button -->
            {{-- <div class="relative">
                <div class="absolute top-0 right-0 inline-flex" x-data="{ open: false }">
                    <button class="text-slate-400 hover:text-slate-500 rounded-full"
                        :class="{ 'bg-slate-100 text-slate-500': open }" aria-haspopup="true"
                        @click.prevent="open = !open" :aria-expanded="open">
                        <span class="sr-only">Menu</span>
                        <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                            <circle cx="16" cy="16" r="2" />
                            <circle cx="10" cy="16" r="2" />
                            <circle cx="22" cy="16" r="2" />
                        </svg>
                    </button>
                    <div class="origin-top-right z-10 absolute top-full right-0 min-w-36 bg-white border border-slate-200 py-1.5 rounded shadow-lg overflow-hidden mt-1"
                        @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
                        x-transition:enter="transition ease-out duration-200 transform"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" x-cloak>
                        <ul>
                            <li>
                                <a class="font-medium text-sm text-rose-500 hover:text-rose-600 flex py-1 px-3"
                                    href="#0" @click="open = false" @focus="open = true"
                                    @focusout="open = false">Remove</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            <!-- Image + name -->
            <header>
                <div class="flex justify-center mb-2">
                    <a class="relative inline-flex items-start" href="#0">
                        <div class="absolute top-0 right-0 -mr-2 bg-white rounded-full shadow" aria-hidden="true">
                            <span class="p-2">{{ $member->location ?? "🇵🇭" }}</span>

                        </div>
                        <img class="rounded-full" src="https://ui-avatars.com/api/?name={{ $member->first_name }} {{ $member->last_name }}" width="64"
                            height="64" alt="{{ $member->first_name }} {{ $member->last_name }}" />
                    </a>
                </div>
                <div class="text-center">
                    <a class="inline-flex text-slate-800 hover:text-slate-900" href="#0">
                        <h2 class="text-xl leading-snug justify-center font-semibold">{{ $member->first_name }} {{ $member->last_name }}</h2>
                    </a>
                </div>
                <div class="flex justify-center items-center"><span
                        class="text-sm font-medium text-slate-400 -mt-0.5 mr-1">
                       {{ $member->email }}
                    </span></div>
            </header>
        </div>
    </div>
</div>
