@component('survey::questions.base', compact('question'))
    <input type="number" name="{{ $question->key }}" id="{{ $question->key }}" class="form-control"
           value="{{ $value ?? old($question->key) }}" {{ ($disabled ?? false) ? 'disabled' : '' }}>
    
    @if(Auth::user()->hasPermissionTo('manage-employees'))
    @slot('report')
        @if($includeResults ?? false)
            {{ number_format((new \MattDaneshvar\Survey\Utilities\Summary($question))->average()) }} (Average)
        @endif
    @endslot
    @endif
@endcomponent