<div id="profile-sidebar"
    class="absolute z-20 top-0 bottom-0 w-full md:w-auto md:static md:top-auto md:bottom-auto -mr-px md:translate-x-0 duration-200 ease-in-out"
    :class="profileSidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <div
        class="sticky top-16 bg-white overflow-x-hidden overflow-y-auto no-scrollbar shrink-0 border-r border-slate-200 md:w-72 xl:w-80 h-[calc(100vh-64px)]">

        <!-- Profile group -->
        <div>
            <!-- Group header -->
            <div class="sticky top-0 z-10">
                <div class="flex items-center bg-white border-b border-slate-200 px-5 h-16">
                    <div class="w-full flex items-center justify-between">
                        <!-- Profile image -->
                        <div class="relative">
                            <div class="grow flex items-center truncate">
                                <img class="w-8 h-8 rounded-full mr-2" src="{{ asset('images/user-avatar-32.png') }}"
                                    width="32" height="32" alt="Group 01" />
                                <div class="truncate" wire:ignore>
                                    @if (in_array(Request::segment(1), ['employee']))
                                        {{ tenant()->company }} Company ✨
                                    @elseif(isset($host))
                                        @if (in_array(Request::segment(2), ['groups']))
                                            {{ $host->name }} Group ✨
                                        @else
                                            {{ $host->name }} Department ✨
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Add button -->
                        <button
                            class="p-1.5 shrink-0 rounded border border-slate-200 hover:border-slate-300 shadow-sm ml-2"  @click.prevent="inviteModalOpen = true">
                            <svg class="w-4 h-4 fill-current text-indigo-500" viewBox="0 0 16 16">
                                <path
                                    d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Group body -->
            <div class="px-5">
                <!-- Search form -->
                {{-- <form class="relative">
                    <label for="profile-search" class="sr-only">Search</label>
                    <input id="profile-search" class="form-input w-full pl-9 focus:border-slate-300" type="search"
                        placeholder="Search…" />
                    <button class="absolute inset-0 right-auto group" type="submit" aria-label="Search">
                        <svg class="w-4 h-4 shrink-0 fill-current text-slate-400 group-hover:text-slate-500 ml-3 mr-2"
                            viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
                            <path
                                d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
                        </svg>
                    </button>
                </form> --}}
                <!-- Team members -->
                <div class="mt-4">
                    <div class="text-xs font-semibold text-slate-400 uppercase mb-3" wire:ignore>
                        @if (in_array(Request::segment(1), ['employee']))
                            Company Employees ✨
                        @else
                            @if (in_array(Request::segment(2), ['groups']))
                                Group Members ✨
                            @else
                                Department Members ✨
                            @endif
                        @endif
                    </div>
                    <ul class="mb-6">
                        @foreach ($users as $user)
                            <li class="-mx-2">
                                <div class="flex items-center space-x-4 p-2 rounded {{ $user->id == $selectedId ? 'bg-indigo-100' : '' }}"
                                    wire:click="$emit('userSelected', {{ $user->id }})">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="{{ $user->profile_photo_url }}">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $user->name }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                            @if ($user->trashed())
                                                <span class="text-red-500">
                                                    Deactivated
                                                </span>
                                            @elseif (isset($host))
                                                <div wire:ignore>
                                                    @if (isset($user->pivot->is_leader))
                                                        @if ($user->pivot->is_leader == '1')
                                                            @if (in_array(Request::segment(2), ['groups']))
                                                                Group Leader
                                                            @else
                                                                Department Head
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>

                                                {{-- {{ ($user->pivot->is_leader == '1' ? 'Leader' : '') ?? '' }} --}}
                                            @else
                                                @if ($user->hasRole('owner'))
                                                    Owner
                                                @elseif($user->hasRole('manager'))
                                                    Manager
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @if ($this->availableMembers != null && count($this->availableMembers) > 0)
                <div wire:key="{{ $this->availableMembers }}">
                    <div class="px-5">
                        <div class="text-xs font-semibold text-slate-400 uppercase mb-3" wire:ignore>
                            Add a new member
                        </div>
                        <ul class="mb-6">
                            @foreach ($this->availableMembers as $user)
                                <li class="-mx-2">
                                    <div class="flex items-center space-x-4 p-2 rounded">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8 rounded-full" src="{{ $user->profile_photo_url }}">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                {{ $user->name }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate">
                                                {{ $user->email }}
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center font-semibold text-xs text-white text-gray-900 rounded-full py-2 px-2 bg-green-600"
                                            wire:click="$emit('addUser', {{ $user->id }})">
                                            ADD
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

        </div>

    </div>
</div>
