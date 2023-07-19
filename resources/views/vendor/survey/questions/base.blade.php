<div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
    <label class="mb-2 text-xl font-bold tracking-tight text-gray-900" for="{{ $question->key }}">
        {{ $question->content }}
        @if ($question->is_required)
            <span class="text-red-800"><b>*</b></span>
        @endif
    </label>

    <div class="mt-4">
        {{ $slot }}
    </div>

    @if ($errors->has($question->key))
        <div class="text-red-500 mt-3">{{ $errors->first($question->key) }}</div>
    @endif

    <div class="text-green-500">
        {{ $report ?? '' }}
    </div>
</div>
