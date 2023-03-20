<div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
    <div class="flex flex-col h-full">
        <!-- Card top -->
        <div class="grow p-5">
            <div class="flex justify-between items-start">
                <!-- Image + name -->
                <header>
                    <div class="flex mb-2">
                        <a class="relative inline-flex items-start mr-5" href="#0">
                            <img class="rounded-full" src="https://ui-avatars.com/api/?name=<?php echo e(fake()->company()); ?>" width="64"
                                height="64" alt="<?php echo e($member->name); ?>" />
                        </a>
                        <div class="mt-1 pr-1">
                            <a class="inline-flex text-slate-800 hover:text-slate-900" href="#0">
                                <h2 class="text-xl leading-snug justify-center font-semibold"><?php echo e(fake()->company()); ?></h2>
                            </a>
                            <div class="flex items-center">
                                <div class="flex -space-x-4">
                                    <img class="w-10 h-10  rounded-full dark:border-gray-800" src="https://picsum.photos/70" alt="">
                                    <img class="w-10 h-10  rounded-full dark:border-gray-800" src="https://picsum.photos/50" alt="">
                                    <img class="w-10 h-10  rounded-full dark:border-gray-800" src="https://picsum.photos/60" alt="">
                                    <a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-700 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">+99</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Menu button -->
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
                                <a class="font-medium text-sm text-rose-500 hover:text-rose-600 flex py-1 px-3"
                                    href="#0" @click="open = false" @focus="open = true"
                                    @focusout="open = false">Remove</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Bio -->
            <div class="mt-2">
                <div class="text-sm"><?php echo e($member->content); ?></div>
            </div>
        </div>
        <!-- Card footer -->
        <div class="border-t border-slate-200">
            <div class="flex divide-x divide-slate-200r">
                <a class="block flex-1 text-center text-sm text-indigo-500 hover:text-indigo-600 font-medium px-3 py-4"
                    href="<?php echo e(route('community.groups.view', 1)); ?>">
                    <div class="flex items-center justify-center">
                        <svg class="w-4 h-4 fill-current shrink-0 mr-2"
                            viewBox="0 0 490.4 490.4" xml:space="preserve">
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
                
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\laravel\mosiac\resources\views/components/community/groups-tiles-cards.blade.php ENDPATH**/ ?>