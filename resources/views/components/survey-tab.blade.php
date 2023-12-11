<div class="p-4 w-full {{ isset($isFirst) ? 'border-y' : 'border-b' }} border-slate-200" x-data="{ open: {{ isset($isFirst) ? 'true' : 'false' }} }">
    <div class="w-full relative cursor-pointer" @click="open = !open">
        <h1 class="font-semibold text-lg text-black">
            <template x-if="open">
                <i class="w-6 fa-solid {{ $icon }} text-indigo-500 mr-2"></i>
            </template>
            <template x-if="!open">
                <i class="w-6 fa-solid {{ $icon }} text-gray-400 mr-2"></i>
            </template>
            {{ ucwords($title) }}
        </h1>
        <div class="absolute -right-2 -top-1 cursor-pointer p-2">
            <template x-if="open">
                <i class="fa-solid fa-chevron-down text-indigo-500 hover:text-indigo-600s"></i>
            </template>
            <template x-if="!open">
                <i class="fa-solid fa-chevron-up text-gray-400 hover:text-gray-600"></i>
            </template>
        </div>
    </div>

    <div class="w-full mt-2 mt-4" x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
        {{ $slot }}
    </div>
</div>
