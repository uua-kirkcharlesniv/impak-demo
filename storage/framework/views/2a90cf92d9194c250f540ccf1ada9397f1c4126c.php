<div>
    <!-- Sidebar backdrop (mobile only) -->
    <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

    <!-- Sidebar -->
    <div id="sidebar"
        class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-slate-800 p-4 transition-all duration-200 ease-in-out"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'" @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false" x-cloak="lg">

        <!-- Sidebar header -->
        <div class="flex justify-between mb-10 pr-3 sm:px-2">
            <!-- Close button -->
            <button class="lg:hidden text-slate-500 hover:text-slate-400" @click.stop="sidebarOpen = !sidebarOpen"
                aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">Close sidebar</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                </svg>
            </button>
            <!-- Logo -->
            <a class="block" href="<?php echo e(route('dashboard')); ?>">
                <svg width="32" height="32" viewBox="0 0 32 32">
                    <defs>
                        <linearGradient x1="28.538%" y1="20.229%" x2="100%" y2="108.156%" id="logo-a">
                            <stop stop-color="#A5B4FC" stop-opacity="0" offset="0%" />
                            <stop stop-color="#A5B4FC" offset="100%" />
                        </linearGradient>
                        <linearGradient x1="88.638%" y1="29.267%" x2="22.42%" y2="100%" id="logo-b">
                            <stop stop-color="#38BDF8" stop-opacity="0" offset="0%" />
                            <stop stop-color="#38BDF8" offset="100%" />
                        </linearGradient>
                    </defs>
                    <rect fill="#6366F1" width="32" height="32" rx="16" />
                    <path
                        d="M18.277.16C26.035 1.267 32 7.938 32 16c0 8.837-7.163 16-16 16a15.937 15.937 0 01-10.426-3.863L18.277.161z"
                        fill="#4F46E5" />
                    <path
                        d="M7.404 2.503l18.339 26.19A15.93 15.93 0 0116 32C7.163 32 0 24.837 0 16 0 10.327 2.952 5.344 7.404 2.503z"
                        fill="url(#logo-a)" />
                    <path
                        d="M2.223 24.14L29.777 7.86A15.926 15.926 0 0132 16c0 8.837-7.163 16-16 16-5.864 0-10.991-3.154-13.777-7.86z"
                        fill="url(#logo-b)" />
                </svg>
            </a>
        </div>

        <!-- Links -->
        <div class="space-y-8">
            <!-- Pages group -->
            <div>
                <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
                    <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
                        aria-hidden="true">•••</span>
                    <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Pages</span>
                </h3>
                <ul class="mt-3">
                    <!-- Dashboard -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 <?php if(in_array(Request::segment(1), ['dashboard'])): ?> <?php echo e('bg-slate-900'); ?> <?php endif; ?>"
                        x-data="{ open: <?php echo e(in_array(Request::segment(1), ['dashboard']) ? 1 : 0); ?> }">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 <?php if(in_array(Request::segment(1), ['dashboard'])): ?> <?php echo e('hover:text-slate-200'); ?> <?php endif; ?>"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path
                                            class="fill-current <?php if(in_array(Request::segment(1), ['dashboard'])): ?> <?php echo e('text-indigo-500'); ?><?php else: ?><?php echo e('text-slate-400'); ?> <?php endif; ?>"
                                            d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z" />
                                        <path
                                            class="fill-current <?php if(in_array(Request::segment(1), ['dashboard'])): ?> <?php echo e('text-indigo-600'); ?><?php else: ?><?php echo e('text-slate-600'); ?> <?php endif; ?>"
                                            d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z" />
                                        <path
                                            class="fill-current <?php if(in_array(Request::segment(1), ['dashboard'])): ?> <?php echo e('text-indigo-200'); ?><?php else: ?><?php echo e('text-slate-400'); ?> <?php endif; ?>"
                                            d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 <?php if(in_array(Request::segment(1), ['dashboard'])): ?> <?php echo e('rotate-180'); ?> <?php endif; ?>"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 <?php if(!in_array(Request::segment(1), ['dashboard'])): ?> <?php echo e('hidden'); ?> <?php endif; ?>"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('dashboard')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('dashboard')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Main</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('analytics')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('analytics')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Surveys</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('fintech')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('fintech')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Mood Board</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Community -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 <?php if(in_array(Request::segment(1), ['community'])): ?> <?php echo e('bg-slate-900'); ?> <?php endif; ?>"
                        x-data="{ open: <?php echo e(in_array(Request::segment(1), ['community']) ? 1 : 0); ?> }">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 <?php if(in_array(Request::segment(1), ['community'])): ?> <?php echo e('hover:text-slate-200'); ?> <?php endif; ?>"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path
                                            class="fill-current <?php if(in_array(Request::segment(1), ['community'])): ?> <?php echo e('text-indigo-500'); ?><?php else: ?><?php echo e('text-slate-600'); ?> <?php endif; ?>"
                                            d="M18.974 8H22a2 2 0 012 2v6h-2v5a1 1 0 01-1 1h-2a1 1 0 01-1-1v-5h-2v-6a2 2 0 012-2h.974zM20 7a2 2 0 11-.001-3.999A2 2 0 0120 7zM2.974 8H6a2 2 0 012 2v6H6v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5H0v-6a2 2 0 012-2h.974zM4 7a2 2 0 11-.001-3.999A2 2 0 014 7z" />
                                        <path
                                            class="fill-current <?php if(in_array(Request::segment(1), ['community'])): ?> <?php echo e('text-indigo-300'); ?><?php else: ?><?php echo e('text-slate-400'); ?> <?php endif; ?>"
                                            d="M12 6a3 3 0 110-6 3 3 0 010 6zm2 18h-4a1 1 0 01-1-1v-6H6v-6a3 3 0 013-3h6a3 3 0 013 3v6h-3v6a1 1 0 01-1 1z" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Community</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 <?php if(in_array(Request::segment(1), ['community'])): ?> <?php echo e('rotate-180'); ?> <?php endif; ?>"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 <?php if(!in_array(Request::segment(1), ['community'])): ?> <?php echo e('hidden'); ?> <?php endif; ?>"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('community.groups.list')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('community.groups.list')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Groups</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('community.departments.list')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('community.departments.list')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Departments</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('profile')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('profile')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Profile</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('community.feed')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('community.feed')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Feed</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('community.events')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('community.events')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Events</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('meetups-post')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('meetups-post')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Meetups
                                            - Post</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Billing -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 <?php if(in_array(Request::segment(1), ['billing'])): ?> <?php echo e('bg-slate-900'); ?> <?php endif; ?>"
                        x-data="{ open: <?php echo e(in_array(Request::segment(1), ['billing']) ? 1 : 0); ?> }">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 <?php if(in_array(Request::segment(1), ['billing'])): ?> <?php echo e('hover:text-slate-200'); ?> <?php endif; ?>"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path
                                            class="fill-current <?php if(in_array(Request::segment(1), ['billing'])): ?> <?php echo e('text-indigo-300'); ?><?php else: ?><?php echo e('text-slate-400'); ?> <?php endif; ?>"
                                            d="M13 6.068a6.035 6.035 0 0 1 4.932 4.933H24c-.486-5.846-5.154-10.515-11-11v6.067Z" />
                                        <path
                                            class="fill-current <?php if(in_array(Request::segment(1), ['billing'])): ?> <?php echo e('text-indigo-500'); ?><?php else: ?><?php echo e('text-slate-700'); ?> <?php endif; ?>"
                                            d="M18.007 13c-.474 2.833-2.919 5-5.864 5a5.888 5.888 0 0 1-3.694-1.304L4 20.731C6.131 22.752 8.992 24 12.143 24c6.232 0 11.35-4.851 11.857-11h-5.993Z" />
                                        <path
                                            class="fill-current <?php if(in_array(Request::segment(1), ['billing'])): ?> <?php echo e('text-indigo-600'); ?><?php else: ?><?php echo e('text-slate-600'); ?> <?php endif; ?>"
                                            d="M6.939 15.007A5.861 5.861 0 0 1 6 11.829c0-2.937 2.167-5.376 5-5.85V0C4.85.507 0 5.614 0 11.83c0 2.695.922 5.174 2.456 7.17l4.483-3.993Z" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Billing</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 <?php if(in_array(Request::segment(1), ['billing'])): ?> <?php echo e('rotate-180'); ?> <?php endif; ?>"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 <?php if(!in_array(Request::segment(1), ['billing'])): ?> <?php echo e('hidden'); ?> <?php endif; ?>"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('billing.credit-cards')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('billing.credit-cards')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cards</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('billing.transactions')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('billing.transactions')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Transactions</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('billing.transaction-details')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('billing.transaction-details')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Transaction
                                            Details</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Calendar -->
                    <li
                        class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 <?php if(in_array(Request::segment(1), ['calendar'])): ?> <?php echo e('bg-slate-900'); ?> <?php endif; ?>">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 <?php if(in_array(Request::segment(1), ['calendar'])): ?> <?php echo e('hover:text-slate-200'); ?> <?php endif; ?>"
                            href="<?php echo e(route('calendar')); ?>">
                            <div class="flex items-center">
                                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                    <path
                                        class="fill-current <?php if(in_array(Request::segment(1), ['calendar'])): ?> <?php echo e('text-indigo-500'); ?><?php else: ?><?php echo e('text-slate-600'); ?> <?php endif; ?>"
                                        d="M1 3h22v20H1z" />
                                    <path
                                        class="fill-current <?php if(in_array(Request::segment(1), ['calendar'])): ?> <?php echo e('text-indigo-300'); ?><?php else: ?><?php echo e('text-slate-400'); ?> <?php endif; ?>"
                                        d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Calendar</span>
                            </div>
                        </a>
                    </li>
                    <!-- Surveys -->
                    <li
                        class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 <?php if(in_array(Request::segment(1), ['campaigns'])): ?> <?php echo e('bg-slate-900'); ?> <?php endif; ?>">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 <?php if(in_array(Request::segment(1), ['campaigns'])): ?> <?php echo e('hover:text-slate-200'); ?> <?php endif; ?>"
                            href="<?php echo e(route('campaigns')); ?>">
                            <div class="flex items-center">
                                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                    <path
                                        class="fill-current <?php if(in_array(Request::segment(1), ['campaigns'])): ?> <?php echo e('text-indigo-500'); ?><?php else: ?><?php echo e('text-slate-600'); ?> <?php endif; ?>"
                                        d="M20 7a.75.75 0 01-.75-.75 1.5 1.5 0 00-1.5-1.5.75.75 0 110-1.5 1.5 1.5 0 001.5-1.5.75.75 0 111.5 0 1.5 1.5 0 001.5 1.5.75.75 0 110 1.5 1.5 1.5 0 00-1.5 1.5A.75.75 0 0120 7zM4 23a.75.75 0 01-.75-.75 1.5 1.5 0 00-1.5-1.5.75.75 0 110-1.5 1.5 1.5 0 001.5-1.5.75.75 0 111.5 0 1.5 1.5 0 001.5 1.5.75.75 0 110 1.5 1.5 1.5 0 00-1.5 1.5A.75.75 0 014 23z" />
                                    <path
                                        class="fill-current <?php if(in_array(Request::segment(1), ['campaigns'])): ?> <?php echo e('text-indigo-300'); ?><?php else: ?><?php echo e('text-slate-400'); ?> <?php endif; ?>"
                                        d="M17 23a1 1 0 01-1-1 4 4 0 00-4-4 1 1 0 010-2 4 4 0 004-4 1 1 0 012 0 4 4 0 004 4 1 1 0 010 2 4 4 0 00-4 4 1 1 0 01-1 1zM7 13a1 1 0 01-1-1 4 4 0 00-4-4 1 1 0 110-2 4 4 0 004-4 1 1 0 112 0 4 4 0 004 4 1 1 0 010 2 4 4 0 00-4 4 1 1 0 01-1 1z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Surveys</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- More group -->
            <div>
                <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
                    <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
                        aria-hidden="true">•••</span>
                    <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">More</span>
                </h3>
                <ul class="mt-3">
                    <!-- Settings -->
                    <li
                        class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 <?php if(in_array(Request::segment(1), ['settings'])): ?> <?php echo e('bg-slate-900'); ?> <?php endif; ?>">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 <?php if(in_array(Request::segment(1), ['settings'])): ?> <?php echo e('hover:text-slate-200'); ?> <?php endif; ?>"
                            href="<?php echo e(route('account')); ?>">
                            <div class="flex items-center">
                                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                    <path
                                        class="fill-current <?php if(in_array(Request::segment(1), ['settings'])): ?> <?php echo e('text-indigo-500'); ?><?php else: ?><?php echo e('text-slate-600'); ?> <?php endif; ?>"
                                        d="M19.714 14.7l-7.007 7.007-1.414-1.414 7.007-7.007c-.195-.4-.298-.84-.3-1.286a3 3 0 113 3 2.969 2.969 0 01-1.286-.3z" />
                                    <path
                                        class="fill-current <?php if(in_array(Request::segment(1), ['settings'])): ?> <?php echo e('text-indigo-300'); ?><?php else: ?><?php echo e('text-slate-400'); ?> <?php endif; ?>"
                                        d="M10.714 18.3c.4-.195.84-.298 1.286-.3a3 3 0 11-3 3c.002-.446.105-.885.3-1.286l-6.007-6.007 1.414-1.414 6.007 6.007z" />
                                    <path
                                        class="fill-current <?php if(in_array(Request::segment(1), ['settings'])): ?> <?php echo e('text-indigo-500'); ?><?php else: ?><?php echo e('text-slate-600'); ?> <?php endif; ?>"
                                        d="M5.7 10.714c.195.4.298.84.3 1.286a3 3 0 11-3-3c.446.002.885.105 1.286.3l7.007-7.007 1.414 1.414L5.7 10.714z" />
                                    <path
                                        class="fill-current <?php if(in_array(Request::segment(1), ['settings'])): ?> <?php echo e('text-indigo-300'); ?><?php else: ?><?php echo e('text-slate-400'); ?> <?php endif; ?>"
                                        d="M19.707 9.292a3.012 3.012 0 00-1.415 1.415L13.286 5.7c-.4.195-.84.298-1.286.3a3 3 0 113-3 2.969 2.969 0 01-.3 1.286l5.007 5.006z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Settings</span>
                            </div>
                        </a>
                    </li>

                    <!-- Utility -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 <?php if(in_array(Request::segment(1), ['utility'])): ?> <?php echo e('bg-slate-900'); ?> <?php endif; ?>"
                        x-data="{ open: <?php echo e(in_array(Request::segment(1), ['utility']) ? 1 : 0); ?> }">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150 <?php if(in_array(Request::segment(1), ['utility'])): ?> <?php echo e('hover:text-slate-200'); ?> <?php endif; ?>"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <circle
                                            class="fill-current <?php if(in_array(Request::segment(1), ['utility'])): ?> <?php echo e('text-indigo-300'); ?><?php else: ?><?php echo e('text-slate-400'); ?> <?php endif; ?>"
                                            cx="18.5" cy="5.5" r="4.5" />
                                        <circle
                                            class="fill-current <?php if(in_array(Request::segment(1), ['utility'])): ?> <?php echo e('text-indigo-500'); ?><?php else: ?><?php echo e('text-slate-600'); ?> <?php endif; ?>"
                                            cx="5.5" cy="5.5" r="4.5" />
                                        <circle
                                            class="fill-current <?php if(in_array(Request::segment(1), ['utility'])): ?> <?php echo e('text-indigo-500'); ?><?php else: ?><?php echo e('text-slate-600'); ?> <?php endif; ?>"
                                            cx="18.5" cy="18.5" r="4.5" />
                                        <circle
                                            class="fill-current <?php if(in_array(Request::segment(1), ['utility'])): ?> <?php echo e('text-indigo-300'); ?><?php else: ?><?php echo e('text-slate-400'); ?> <?php endif; ?>"
                                            cx="5.5" cy="18.5" r="4.5" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Utility</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 <?php if(in_array(Request::segment(1), ['utility'])): ?> <?php echo e('rotate-180'); ?> <?php endif; ?>"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 <?php if(!in_array(Request::segment(1), ['utility'])): ?> <?php echo e('hidden'); ?> <?php endif; ?>"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('changelog')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('changelog')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Changelog</span>
                                    </a>
                                </li>
                                
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('faqs')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('faqs')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">FAQs</span>
                                    </a>
                                </li>
                                
                                
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('knowledge-base')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('knowledge-base')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Knowledge
                                            Base</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Authentication -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" x-data="{ open: false }">
                        <a class="block text-slate-200 transition duration-150"
                            :class="open ? 'hover:text-slate-200' : 'hover:text-white'" href="#0"
                            @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path class="fill-current text-slate-600"
                                            d="M8.07 16H10V8H8.07a8 8 0 110 8z" />
                                        <path class="fill-current text-slate-400" d="M15 12L8 6v5H0v2h8v5z" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Authentication</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400"
                                        :class="{ 'rotate-180': open }" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1" :class="{ 'hidden': !open }" x-cloak>
                                <li class="mb-1 last:mb-0">
                                    <form method="POST" action="<?php echo e(route('logout')); ?>" x-data>
                                        <?php echo csrf_field(); ?>

                                        <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
                                            href="<?php echo e(route('logout')); ?>" @click.prevent="$root.submit();">
                                            <span
                                                class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Sign
                                                In</span>
                                        </a>
                                    </form>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <form method="POST" action="<?php echo e(route('logout')); ?>" x-data>
                                        <?php echo csrf_field(); ?>

                                        <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
                                            href="<?php echo e(route('logout')); ?>" @click.prevent="$root.submit();">
                                            <span
                                                class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Sign
                                                Up</span>
                                        </a>
                                    </form>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <form method="POST" action="<?php echo e(route('logout')); ?>" x-data>
                                        <?php echo csrf_field(); ?>

                                        <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
                                            href="<?php echo e(route('logout')); ?>" @click.prevent="$root.submit();">
                                            <span
                                                class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Reset
                                                Password</span>
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Onboarding -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0" x-data="{ open: false }">
                        <a class="block text-slate-200 transition duration-150"
                            :class="open ? 'hover:text-slate-200' : 'hover:text-white'" href="#0"
                            @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path class="fill-current text-slate-600"
                                            d="M19 5h1v14h-2V7.414L5.707 19.707 5 19H4V5h2v11.586L18.293 4.293 19 5Z" />
                                        <path class="fill-current text-slate-400"
                                            d="M5 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm14 0a4 4 0 1 1 0-8 4 4 0 0 1 0 8ZM5 23a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm14 0a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Onboarding</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400"
                                        :class="{ 'rotate-180': open }" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 <?php if(!in_array(Request::segment(1), ['onboarding'])): ?> <?php echo e('hidden'); ?> <?php endif; ?>"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
                                        href="<?php echo e(route('onboarding-01')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Step
                                            1</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
                                        href="<?php echo e(route('onboarding-02')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Step
                                            2</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
                                        href="<?php echo e(route('onboarding-03')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Step
                                            3</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate"
                                        href="<?php echo e(route('onboarding-04')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Step
                                            4</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Components -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 <?php if(in_array(Request::segment(1), ['component'])): ?> <?php echo e('bg-slate-900'); ?> <?php endif; ?>"
                        x-data="{ open: <?php echo e(in_array(Request::segment(1), ['component']) ? 1 : 0); ?> }">
                        <a class="block text-slate-200 transition duration-150"
                            :class="open ? 'hover:text-slate-200' : 'hover:text-white'" href="#0"
                            @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <circle
                                            class="fill-current <?php if(in_array(Request::segment(1), ['component'])): ?> <?php echo e('text-indigo-500'); ?><?php else: ?><?php echo e('text-slate-600'); ?> <?php endif; ?>"
                                            cx="16" cy="8" r="8" />
                                        <circle
                                            class="fill-current <?php if(in_array(Request::segment(1), ['component'])): ?> <?php echo e('text-indigo-300'); ?><?php else: ?><?php echo e('text-slate-400'); ?> <?php endif; ?>"
                                            cx="8" cy="16" r="8" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Components</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400"
                                        :class="{ 'rotate-180': open }" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 <?php if(!in_array(Request::segment(1), ['component'])): ?> <?php echo e('hidden'); ?> <?php endif; ?>"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('button-page')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('button-page')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Button</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('form-page')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('form-page')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Input
                                            Form</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('dropdown-page')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('dropdown-page')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dropdown</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('alert-page')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('alert-page')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Alert
                                            & Banner</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('modal-page')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('modal-page')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Modal</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('pagination-page')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('pagination-page')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Pagination</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('tabs-page')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('tabs-page')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Tabs</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('breadcrumb-page')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('breadcrumb-page')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Breadcrumb</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('badge-page')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('badge-page')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Badge</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('avatar-page')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('avatar-page')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Avatar</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('tooltip-page')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('tooltip-page')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Tooltip</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('accordion-page')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('accordion-page')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Accordion</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate <?php if(Route::is('icons-page')): ?> <?php echo e('!text-indigo-500'); ?> <?php endif; ?>"
                                        href="<?php echo e(route('icons-page')); ?>">
                                        <span
                                            class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Icons</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Expand / collapse button -->
        <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
            <div class="px-3 py-2">
                <button @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Expand / collapse sidebar</span>
                    <svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
                        <path class="text-slate-400"
                            d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
                        <path class="text-slate-600" d="M3 23H1V1h2z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>
<?php /**PATH /Volumes/240/valet-sites/mosiac/resources/views/components/app/sidebar.blade.php ENDPATH**/ ?>