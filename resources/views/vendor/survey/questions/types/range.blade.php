@component('survey::questions.base', compact('question'))
    <input type="range" min="0" max="10" step="1" name="{{ $question->key }}" id="{{ $question->key }}"
        class="w-full">
@endcomponent
