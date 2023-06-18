<div>
    <div class="flex">
        <div class="flex items-center h-5">
            <input wire:model="allUsers" id="helper-checkbox" aria-describedby="helper-checkbox-text" type="checkbox"
                class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
        </div>
        <div class="ml-2 text-sm">
            <label for="helper-checkbox" class="font-medium text-gray-900">Start a company wide survey</label>
            <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500">{{ $users->total() }} unique users
                will be targeted in this survey.</p>
        </div>
    </div>
    @if (!$allUsers)
        <div class="mt-4"></div>
        <div class="bg-slate-100 p-5 rounded-md">
            @if (!$allUsers)
                @foreach ($users as $user)
                    <div class="flex items-center space-x-4 mb-2">
                        <div class="flex-shrink-0">
                            <img class="w-8 h-8 rounded-full"
                                src="https://ui-avatars.com/api/?name={{ $user->name }}&amp;color=7F9CF5&amp;background=EBF4FF">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ $user->name }}
                            </p>
                            <p class="text-sm text-gray-500 truncate">
                                {{ $user->email }}
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900">
                            <input type="checkbox" class="form-checkbox mt-1" name="terms" />
                        </div>
                    </div>
                @endforeach
            @endif
            {{ $users->links() }}
        </div>

        @if (!$allUsers)
            <hr class="my-2">

            <div class="bg-slate-100 p-5 rounded-md">
                <div class="flex items-center mr-4 mb-3">
                    <input type="checkbox" wire:model="allGroups"
                        class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                    <label for="purple-checkbox" class="ml-2 text-sm font-medium text-gray-900">Select all groups
                        ({{ $groups->total() }})</label>
                </div>
                @if (!$allGroups)
                    @foreach ($groups as $group)
                        <div class="flex items-center space-x-4 mb-2">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-full"
                                    src="https://ui-avatars.com/api/?name={{ $group->name }}&amp;color=7F9CF5&amp;background=EBF4FF">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $group->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                <div class="flex shrink-0 -space-x-3 -ml-px">
                                    @foreach ($group->members as $userMember)
                                        <a class="block" href="#">
                                            <img class="rounded-full border-2 border-white box-content"
                                                src="https://ui-avatars.com/api/?name={{ $userMember->name }}"
                                                width="28" height="28" />
                                        </a>
                                    @endforeach
                                </div>
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                <input type="checkbox" class="form-checkbox mt-1" name="terms" />
                            </div>
                        </div>
                    @endforeach
                @endif
                {{ $groups->links() }}
            </div>

            <hr class="my-2">

            <div class="bg-slate-100 p-5 rounded-md">
                <div class="flex items-center mr-4 mb-3">
                    <input type="checkbox" wire:model="allDepartments"
                        class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                    <label for="purple-checkbox" class="ml-2 text-sm font-medium text-gray-900">Select all departments
                        ({{ $departments->total() }})</label>
                </div>
                @if (!$allDepartments)
                    @foreach ($departments as $department)
                        <div class="flex items-center space-x-4 mb-2">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-full"
                                    src="https://ui-avatars.com/api/?name={{ $department->name }}&amp;color=7F9CF5&amp;background=EBF4FF">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $department->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                <div class="flex shrink-0 -space-x-3 -ml-px">
                                    @foreach ($department->members as $userMember)
                                        <a class="block" href="#">
                                            <img class="rounded-full border-2 border-white box-content"
                                                src="https://ui-avatars.com/api/?name={{ $userMember->name }}"
                                                width="28" height="28" />
                                        </a>
                                    @endforeach
                                </div>
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                <input type="checkbox" class="form-checkbox mt-1" name="terms" />
                            </div>
                        </div>
                    @endforeach
                @endif
                {{ $departments->links() }}
            </div>
        @endif
    @endif
</div>
