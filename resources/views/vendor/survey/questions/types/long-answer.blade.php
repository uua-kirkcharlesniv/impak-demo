@component('survey::questions.base', compact('question'))
    <textarea name="{{ $question->key }}" maxlength="{{ $question->max }}" id="{{ $question->key }}" class="form-input w-full"
        {{ $disabled ?? false ? 'disabled' : '' }}>{{ $value ?? old($question->key) }}</textarea>

    @if (isset($question->min))
        <span class="text-sm text-gray-400">Minimum of {{ $question->min }} characters. </span>
    @endif
    @if (isset($question->max))
        <span class="text-sm text-gray-400">Maximum of {{ $question->max }} characters. </span>
    @endif
@endcomponent
