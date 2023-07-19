@component('survey::questions.base', compact('question'))
    <div class="flex items-center justify-around w-full">
        @foreach (generateLikertNames($question->likert_type, $question->likert_order) as $index => $option)
            <label
                class="relative block flex flex-col items-center hover:border hover:shadow-lg rounded border-indigo-700 p-6">
                <input type="radio" name="{{ $question->key }}" value="{{ $option }}"
                    id="{{ $question->key . '-' . Str::slug($option) }}"
                    {{ ($value ?? old($question->key)) == $option ? 'checked' : '' }} class="peer sr-only">

                {!! fetchLikertFace($question->likert_type, $index, $question->likert_order) !!}

                <span class="text-lg font-bold">{{ $option }}</span>
                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-indigo-400 rounded pointer-events-none"
                    aria-hidden="true"></div>
            </label>
        @endforeach
    </div>
@endcomponent
