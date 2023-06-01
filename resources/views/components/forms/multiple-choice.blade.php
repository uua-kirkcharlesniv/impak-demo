<div>
    <label class="relative block cursor-pointer">
        <input type="radio" name="radio-buttons" class="peer sr-only" checked />
        <div
            class="flex items-center bg-white text-sm font-medium text-slate-800 p-4 rounded border border-slate-200 hover:border-slate-300 shadow-sm duration-150 ease-in-out">
            @isset($emoji)
                <span class="text-2xl w-7 h-7 mr-4 ">{{ $emoji }}</span>
            @endisset
            <span>{{ $name }}</span>
        </div>
        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-indigo-400 rounded pointer-events-none"
        aria-hidden="true"></div>
    </label>
    @isset($helper)
    <p id="helper-text-explanation" class="text-sm text-gray-500">{{ $helper }}</p>
    @endisset
</div>
