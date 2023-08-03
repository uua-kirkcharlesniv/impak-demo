<div class="grow flex flex-col md:translate-x-0 duration-300 ease-in-out">

    <!-- Profile background -->
    <div class="relative h-56 bg-slate-200">
        <div class="object-cover h-full w-full flex items-center justify-center" width="1000    " height="220">

            <h1 class="font-extrabold text-transparent text-8xl bg-clip-text"
                style="background: #121FCF;
                background: radial-gradient(circle farthest-corner at center center, #121FCF 0%, #CF1512 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;">
                {{ tenant()->company }} company
            </h1>

        </div>

    </div>

    <!-- Content -->
    <div class="relative px-4 sm:px-6 pb-8">

        <!-- Pre-header -->
        <div class="-mt-16 mb-6 sm:mb-3">

            <div class="flex flex-col items-center sm:flex-row sm:justify-between sm:items-end">

                <!-- Avatar -->
                <div class="inline-flex -ml-1 -mt-1 mb-4 sm:mb-0">
                    <img class="rounded-full border-4 border-white" src="{{ $user->profile_photo_url }}" width="128"
                        height="128" alt="Avatar" />
                </div>

                <!-- Actions -->
                <div class="flex space-x-2 sm:mb-2">

                    @if (Auth::user()->hasPermissionTo('manage-groups') ||
                            Auth::user()->hasPermissionTo('manage-departments') ||
                            Auth::user()->id == $user->id)
                        @if (!isset($host) && Auth::user()->hasPermissionTo('manage-employees') && $user->trashed())
                            <button
                                class="p-1.5 shrink-0 rounded border border-green-400 hover:border-slate-300 shadow-sm"
                                wire:click="reactivateUser">
                                <span class="text-lg text-green-700">Reactivate</span>
                            </button>
                        @else
                            @if (!isset($host) && Auth::user()->hasPermissionTo('manage-employees') && Auth::user()->id == $user->id)
                            @elseif (!isset($host) && Auth::user()->id == $user->id)
                            @else
                                <button
                                    class="p-1.5 shrink-0 rounded border border-slate-200 hover:border-slate-300 shadow-sm"
                                    wire:click="deleteDoAction">
                                    @if (Auth::user()->id == $user->id)
                                        <i class="fa-regular text-xl text-red-700 fa-right-from-bracket"></i>
                                    @else
                                        <i class="fa-regular text-xl text-red-700 fa-trash"></i>
                                    @endif
                                </button>
                            @endif
                        @endif
                    @endif
                </div>

            </div>

        </div>

        <!-- Header -->
        <header class="text-center sm:text-left mb-6">
            <!-- Name -->
            <div class="inline-flex items-start mb-2">
                <h1 class="text-2xl text-slate-800 font-bold">{{ $user->name }}</h1>
                <svg class="w-4 h-4 fill-current shrink-0 text-amber-500 ml-2" viewBox="0 0 16 16">
                    <path
                        d="M13 6a.75.75 0 0 1-.75-.75 1.5 1.5 0 0 0-1.5-1.5.75.75 0 1 1 0-1.5 1.5 1.5 0 0 0 1.5-1.5.75.75 0 1 1 1.5 0 1.5 1.5 0 0 0 1.5 1.5.75.75 0 1 1 0 1.5 1.5 1.5 0 0 0-1.5 1.5A.75.75 0 0 1 13 6ZM6 16a1 1 0 0 1-1-1 4 4 0 0 0-4-4 1 1 0 0 1 0-2 4 4 0 0 0 4-4 1 1 0 1 1 2 0 4 4 0 0 0 4 4 1 1 0 0 1 0 2 4 4 0 0 0-4 4 1 1 0 0 1-1 1Z" />
                </svg>
            </div>

        </header>


        <!-- Profile content -->
        <div class="flex flex-col xl:flex-row xl:space-x-16">

            <!-- Main content -->
            <div class="flex-auto space-y-5 mb-8 xl:mb-0">

                <!-- Departments -->
                <div>
                    <h2 class="text-slate-800 font-semibold mb-2">Departments</h2>
                    <!-- Cards -->
                    <div class="grid xl:grid-cols-2 gap-4">
                        @foreach ($user->departments as $department)
                            <!-- Card -->
                            <div class="bg-white p-4 border border-slate-200 rounded-sm shadow-sm">
                                <!-- Card header -->
                                <div class="grow flex items-center truncate mb-2">
                                    <div
                                        class="w-8 h-8 shrink-0 flex items-center justify-center bg-slate-700 rounded-full mr-2">
                                        <img class="ml-1" src="{{ asset('images/icon-03.svg') }}" width="14"
                                            height="14" alt="Icon 03" />
                                    </div>
                                    <div class="truncate">
                                        <span class="text-sm font-medium text-slate-800">{{ $department->name }}</span>
                                    </div>
                                </div>
                                <!-- Card content -->
                                <div class="text-sm mb-3"></div>
                                <!-- Card footer -->
                                <div class="flex justify-between items-center">
                                    <!-- Avatars group -->
                                    <div class="flex -space-x-3 -ml-0.5">
                                        @foreach ($department->members as $member)
                                            <img class="rounded-full border-2 border-white box-content"
                                                src="{{ $member->profile_photo_url }}" width="24" height="24"
                                                alt="Avatar" />
                                        @endforeach
                                    </div>
                                    <!-- Link -->
                                    <div>
                                        <a class="text-sm font-medium text-indigo-500 hover:text-indigo-600"
                                            href="{{ route('community.departments.view', $department->id) }}">View
                                            -&gt;</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Departments -->
                <div>
                    <h2 class="text-slate-800 font-semibold mb-2">Groups</h2>
                    <!-- Cards -->
                    <div class="grid xl:grid-cols-2 gap-4">
                        @foreach ($user->groups as $group)
                            <!-- Card -->
                            <div class="bg-white p-4 border border-slate-200 rounded-sm shadow-sm">
                                <!-- Card header -->
                                <div class="grow flex items-center truncate mb-2">
                                    <div
                                        class="w-8 h-8 shrink-0 flex items-center justify-center bg-slate-700 rounded-full mr-2">
                                        <img class="ml-1" src="{{ asset('images/icon-03.svg') }}" width="14"
                                            height="14" alt="Icon 03" />
                                    </div>
                                    <div class="truncate">
                                        <span class="text-sm font-medium text-slate-800">{{ $group->name }}</span>
                                    </div>
                                </div>
                                <!-- Card content -->
                                <div class="text-sm mb-3"></div>
                                <!-- Card footer -->
                                <div class="flex justify-between items-center">
                                    <!-- Avatars group -->
                                    <div class="flex -space-x-3 -ml-0.5">
                                        @foreach ($group->members as $member)
                                            <img class="rounded-full border-2 border-white box-content"
                                                src="{{ $member->profile_photo_url }}" width="24" height="24"
                                                alt="Avatar" />
                                        @endforeach
                                    </div>
                                    <!-- Link -->
                                    <div>
                                        <a class="text-sm font-medium text-indigo-500 hover:text-indigo-600"
                                            href="{{ route('community.groups.view', $group->id) }}">View -&gt;</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Work History -->
                <div>
                    <h2 class="text-slate-800 font-semibold mb-2">Points History</h2>
                    <div class="bg-white p-4 border border-slate-200 rounded-sm shadow-sm">
                        <ul class="space-y-3">

                            <!-- Item -->
                            <li class="sm:flex sm:items-center sm:justify-between">
                                <div class="sm:grow flex items-center text-sm">
                                    <!-- Icon -->
                                    <div class="w-8 h-8 rounded-full shrink-0 bg-amber-500 my-2 mr-3">
                                        <svg class="w-8 h-8 fill-current text-amber-50" viewBox="0 0 32 32">
                                            <path
                                                d="M21 14a.75.75 0 0 1-.75-.75 1.5 1.5 0 0 0-1.5-1.5.75.75 0 1 1 0-1.5 1.5 1.5 0 0 0 1.5-1.5.75.75 0 1 1 1.5 0 1.5 1.5 0 0 0 1.5 1.5.75.75 0 1 1 0 1.5 1.5 1.5 0 0 0-1.5 1.5.75.75 0 0 1-.75.75Zm-7 10a1 1 0 0 1-1-1 4 4 0 0 0-4-4 1 1 0 0 1 0-2 4 4 0 0 0 4-4 1 1 0 0 1 2 0 4 4 0 0 0 4 4 1 1 0 0 1 0 2 4 4 0 0 0-4 4 1 1 0 0 1-1 1Z" />
                                        </svg>
                                    </div>
                                    <!-- Position -->
                                    <div>
                                        <div class="font-medium text-slate-800">Senior Product Designer</div>
                                        <div class="flex flex-nowrap items-center space-x-2 whitespace-nowrap">
                                            <div>Remote</div>
                                            <div class="text-slate-400">·</div>
                                            <div>April, 2020 - Today</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tags -->
                                <div class="sm:ml-2 mt-2 sm:mt-0">
                                    <ul class="flex flex-wrap sm:justify-end -m-1">
                                        <li class="m-1">
                                            <button
                                                class="inline-flex items-center justify-center text-xs font-medium leading-5 rounded-full px-2.5 py-0.5 border border-slate-200 hover:border-slate-300 shadow-sm bg-white text-slate-500 duration-150 ease-in-out">Marketing</button>
                                        </li>
                                        <li class="m-1">
                                            <button
                                                class="inline-flex items-center justify-center text-xs font-medium leading-5 rounded-full px-2.5 py-0.5 border border-slate-200 hover:border-slate-300 shadow-sm bg-white text-slate-500 duration-150 ease-in-out">+4</button>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Item -->
                            <li class="sm:flex sm:items-center sm:justify-between">
                                <div class="sm:grow flex items-center text-sm">
                                    <!-- Icon -->
                                    <div class="w-8 h-8 rounded-full shrink-0 bg-indigo-500 my-2 mr-3">
                                        <svg class="w-8 h-8 fill-current text-indigo-50" viewBox="0 0 32 32">
                                            <path
                                                d="M8.994 20.006a1 1 0 0 1-.707-1.707l4.5-4.5a1 1 0 0 1 1.414 0l3.293 3.293 4.793-4.793a1 1 0 1 1 1.414 1.414l-5.5 5.5a1 1 0 0 1-1.414 0l-3.293-3.293L9.7 19.713a1 1 0 0 1-.707.293Z" />
                                        </svg>
                                    </div>
                                    <!-- Position -->
                                    <div>
                                        <div class="font-medium text-slate-800">Product Designer</div>
                                        <div class="flex flex-nowrap items-center space-x-2 whitespace-nowrap">
                                            <div>Milan, IT</div>
                                            <div class="text-slate-400">·</div>
                                            <div>April, 2018 - April 2020</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tags -->
                                <div class="sm:ml-2 mt-2 sm:mt-0">
                                    <ul class="flex flex-wrap sm:justify-end -m-1">
                                        <li class="m-1">
                                            <button
                                                class="inline-flex items-center justify-center text-xs font-medium leading-5 rounded-full px-2.5 py-0.5 border border-slate-200 hover:border-slate-300 shadow-sm bg-white text-slate-500 duration-150 ease-in-out">Marketing</button>
                                        </li>
                                        <li class="m-1">
                                            <button
                                                class="inline-flex items-center justify-center text-xs font-medium leading-5 rounded-full px-2.5 py-0.5 border border-slate-200 hover:border-slate-300 shadow-sm bg-white text-slate-500 duration-150 ease-in-out">+4</button>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Item -->
                            <li class="sm:flex sm:items-center sm:justify-between">
                                <div class="sm:grow flex items-center text-sm">
                                    <!-- Icon -->
                                    <div class="w-8 h-8 rounded-full shrink-0 bg-indigo-500 my-2 mr-3">
                                        <svg class="w-8 h-8 fill-current text-indigo-50" viewBox="0 0 32 32">
                                            <path
                                                d="M8.994 20.006a1 1 0 0 1-.707-1.707l4.5-4.5a1 1 0 0 1 1.414 0l3.293 3.293 4.793-4.793a1 1 0 1 1 1.414 1.414l-5.5 5.5a1 1 0 0 1-1.414 0l-3.293-3.293L9.7 19.713a1 1 0 0 1-.707.293Z" />
                                        </svg>
                                    </div>
                                    <!-- Position -->
                                    <div>
                                        <div class="font-medium text-slate-800">Product Designer</div>
                                        <div class="flex flex-nowrap items-center space-x-2 whitespace-nowrap">
                                            <div>Milan, IT</div>
                                            <div class="text-slate-400">·</div>
                                            <div>April, 2018 - April 2020</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tags -->
                                <div class="sm:ml-2 mt-2 sm:mt-0">
                                    <ul class="flex flex-wrap sm:justify-end -m-1">
                                        <li class="m-1">
                                            <button
                                                class="inline-flex items-center justify-center text-xs font-medium leading-5 rounded-full px-2.5 py-0.5 border border-slate-200 hover:border-slate-300 shadow-sm bg-white text-slate-500 duration-150 ease-in-out">Marketing</button>
                                        </li>
                                        <li class="m-1">
                                            <button
                                                class="inline-flex items-center justify-center text-xs font-medium leading-5 rounded-full px-2.5 py-0.5 border border-slate-200 hover:border-slate-300 shadow-sm bg-white text-slate-500 duration-150 ease-in-out">+4</button>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <aside class=" xl:min-w-56 xl:w-56 space-y-3">
                <div class="text-sm" wire:ignore.self>
                    <h3 class="font-medium text-slate-800">Title</h3>
                    <div>
                        @if (isset($host))
                            @if (isset($user->pivot->is_leader))
                                @if ($user->pivot->is_leader == '1')
                                    @if (in_array(Request::segment(2), ['groups']))
                                        Group Leader
                                    @else
                                        Department Head
                                    @endif
                                @else
                                    Member
                                @endif
                            @else
                                Member
                            @endif
                            {{-- {{ ($user->pivot->is_leader == '1' ? 'Leader' : '') ?? '' }} --}}
                        @else
                            @if ($user->hasRole('owner'))
                                Owner
                            @elseif($user->hasRole('manager'))
                                Manager
                            @else
                                Employee
                            @endif
                        @endif
                    </div>
                </div>
                <div class="text-sm">
                    <h3 class="font-medium text-slate-800">Location</h3>
                    <div>{{ $user->country }}, {{ $user->city }}</div>
                </div>
                <div class="text-sm">
                    <h3 class="font-medium text-slate-800">Email</h3>
                    <div>{{ $user->email }}</div>
                </div>
                <div class="text-sm">
                    <h3 class="font-medium text-slate-800">Birthdate</h3>
                    <div>{{ \Carbon\Carbon::parse($user->dob)->toFormattedDateString() }}</div>
                </div>
                <div class="text-sm">
                    <h3 class="font-medium text-slate-800">Joined {{ tenant()->company }} ✨</h3>
                    <div>{{ \Carbon\Carbon::parse($user->doh)->toFormattedDateString() }}</div>
                </div>
                <div>
                    @if (isset($host))
                        @if (isset($user->pivot))
                            <div class="text-sm">
                                <h3 class="font-medium text-slate-800">Joined {{ $host->name }}</h3>
                                <div>{{ \Carbon\Carbon::parse($user->pivot->created_at)->toFormattedDateString() }}
                                </div>
                            </div>
                        @endif
                    @endif
                </div>

            </aside>

        </div>

    </div>

</div>
