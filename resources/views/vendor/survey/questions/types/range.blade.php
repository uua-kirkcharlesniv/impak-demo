@component('survey::questions.base', compact('question'))
    <input type="range" min="1" max="10" step="1" name="{{ $question->key }}" id="{{ $question->key }}"
        class="w-full" list="markers">
    <datalist id="markers">
        <option value="1"></option>
        <option value="2"></option>
        <option value="3"></option>
        <option value="4"></option>
        <option value="5"></option>
        <option value="6"></option>
        <option value="7"></option>
        <option value="8"></option>
        <option value="9"></option>
        <option value="10"></option>
    </datalist>
@endcomponent
