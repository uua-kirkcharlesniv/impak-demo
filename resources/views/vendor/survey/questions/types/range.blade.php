@component('survey::questions.base', compact('question'))
    <div class="flex">
        <label class="font-bold text-right mr-2">{{ $question->options[0] }}</label>
        <input type="range" min="{{ $question->min }}" max="{{ $question->max }}" step="1" name="{{ $question->key }}"
            id="{{ $question->key }}" class="w-full" list="markers">
        <label class="font-bold ml-2">{{ $question->options[1] }}</label>
    </div>

    <datalist id="markers">
        @for ($i = $question->min; $i <= $question->max; $i++)
            <option value="{{ $i }}"></option>
        @endfor
    </datalist>
@endcomponent
