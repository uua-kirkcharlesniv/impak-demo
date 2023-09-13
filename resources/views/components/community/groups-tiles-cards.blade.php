<div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">

    <div class="flex flex-col h-full">
        <!-- Card top -->
        <div class="grow p-5">
            <div class="flex justify-between items-start">
                <!-- Image + name -->
                <header>
                    <div class="flex mb-2">
                        <a class="relative inline-flex items-start mr-5" href="#0">
                            <img class="rounded-full" src="https://ui-avatars.com/api/?name={{ $member->name }}"
                                width="64" height="64" alt="{{ $member->name }}" />
                        </a>
                        <div class="mt-1 pr-1">
                            <a class="inline-flex text-slate-800 hover:text-slate-900" href="#0">
                                <h2 class="text-xl leading-snug justify-center font-semibold">{{ $member->name }}</h2>
                            </a>
                            <div class="flex shrink-0 -space-x-3 -ml-px">
                                @foreach ($member->members as $userMember)
                                    <a class="block" href="#">
                                        <img class="rounded-full border-2 border-white box-content"
                                            src="https://ui-avatars.com/api/?name={{ $userMember->name }}"
                                            width="28" height="28" alt="{{ $member->name }}" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Menu button -->
                @if (Auth::user()->hasPermissionTo('manage-groups') || Auth::user()->hasPermissionTo('manage-departments'))
                    <div class="relative inline-flex shrink-0" x-data="{ open: false }">
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
                                    @if (in_array(Request::segment(2), ['groups']))
                                        <a class="font-medium text-sm text-rose-500 hover:text-rose-600 flex py-1 px-3"
                                            href="{{ route('community.groups.delete', $member->id) }}"
                                            @click="open = false" @focus="open = true"
                                            @focusout="open = false">Remove</a>
                                    @elseif (in_array(Request::segment(2), ['departments']))
                                        <a class="font-medium text-sm text-rose-500 hover:text-rose-600 flex py-1 px-3"
                                            href="{{ route('community.departments.delete', $member->id) }}"
                                            @click="open = false" @focus="open = true"
                                            @focusout="open = false">Remove</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif

            </div>
            <!-- Bio -->
            <div class="mt-2">
                <div class="text-sm">{{ $member->content }}</div>
            </div>
        </div>
        <!-- Card footer -->
        <div class="border-t border-slate-200">
            <div class="flex divide-x divide-slate-200r">
                <a class="block flex-1 text-center text-sm text-indigo-500 hover:text-indigo-600 font-medium px-3 py-4"
                    @if (in_array(Request::segment(2), ['groups'])) href="{{ route('community.groups.view', $member->id) }}" 👥 @else href="{{ route('community.departments.view', 1) }}" 💼 @endif>
                    <div class="flex items-center justify-center">
                        <svg class="w-4 h-4 fill-current shrink-0 mr-2" viewBox="0 0 490.4 490.4" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <path
                                        d="M484.1,454.796l-110.5-110.6c29.8-36.3,47.6-82.8,47.6-133.4c0-116.3-94.3-210.6-210.6-210.6S0,94.496,0,210.796 s94.3,210.6,210.6,210.6c50.8,0,97.4-18,133.8-48l110.5,110.5c12.9,11.8,25,4.2,29.2,0C492.5,475.596,492.5,463.096,484.1,454.796z M41.1,210.796c0-93.6,75.9-169.5,169.5-169.5s169.6,75.9,169.6,169.5s-75.9,169.5-169.5,169.5S41.1,304.396,41.1,210.796z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        <span>View</span>
                    </div>
                </a>
                {{-- <a class="block flex-1 text-center text-sm text-slate-600 hover:text-slate-800 font-medium px-3 py-4 group" href="{{ route('settings') }}">
                    <div class="flex items-center justify-center">
                        <svg class="w-4 h-4 fill-current text-slate-400 group-hover:text-slate-500 shrink-0 mr-2" viewBox="0 0 16 16">
                            <path d="M11.7.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM4.6 14H2v-2.6l6-6L10.6 8l-6 6zM12 6.6L9.4 4 11 2.4 13.6 5 12 6.6z" />
                        </svg>
                        <span>Edit Profile</span>
                    </div>
                </a> --}}
            </div>
        </div>
    </div>
</div>
