@component('survey::questions.base', compact('question'))
    <input type="text" maxlength="{{ $question->max }}" name="{{ $question->key }}" id="{{ $question->key }}"
        class="form-input w-full" value="{{ $value ?? old($question->key) }}" {{ $disabled ?? false ? 'disabled' : '' }}>

    @if (isset($question->min))
        <span class="text-sm text-gray-400">Minimum of {{ $question->min }} characters. </span>
    @endif
    @if (isset($question->max))
        <span class="text-sm text-gray-400">Maximum of {{ $question->max }} characters. </span>
    @endif
@endcomponent
