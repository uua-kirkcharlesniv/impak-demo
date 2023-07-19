@component('survey::questions.base', compact('question'))
    @foreach ($question->options as $option)
        <div class="mb-2">
            <label class="relative block cursor-pointer">
                <input type="radio" name="{{ $question->key }}" id="{{ $question->key . '-' . Str::slug($option) }}"
                    value="{{ $option }}" class="peer sr-only"
                    {{ ($value ?? old($question->key)) == $option ? 'checked' : '' }}
                    {{ $disabled ?? false ? 'disabled' : '' }} />
                <div
                    class="flex items-center bg-white text-sm font-medium text-slate-800 p-4 rounded border border-slate-200 hover:border-slate-300 shadow-sm duration-150 ease-in-out">
                    <span>{{ $option }}</span>
                </div>
                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-indigo-400 rounded pointer-events-none"
                    aria-hidden="true"></div>
            </label>


            <label class="custom-control-label" for="{{ $question->key . '-' . Str::slug($option) }}">
                @if ($includeResults ?? false)
                    <span class="text-success">
                        ({{ number_format((new \MattDaneshvar\Survey\Utilities\Summary($question))->similarAnswersRatio($option) * 100, 2) }}%)
                    </span>
                @endif
            </label>
        </div>
    @endforeach
@endcomponent
