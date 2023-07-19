@component('survey::questions.base', compact('question'))
    <div id="checkboxgroup-{{ $question->key }}">
        @foreach ($question->options as $option)
            <div class="mb-2">
                <label class="relative block cursor-pointer">
                    <input type="checkbox" name="{{ $question->key }}[]" id="{{ $question->key . '-' . Str::slug($option) }}"
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
            </div>
        @endforeach
    </div>

    @if (isset($question->min))
        <span class="text-sm text-gray-400">Minimum selection of {{ $question->min }} answers. </span>
    @endif
    @if (isset($question->max))
        <span class="text-sm text-gray-400">Max selection of {{ $question->max }} answers. </span>

        <script>
            var checkboxgroup = document.getElementById('checkboxgroup-{{ $question->key }}').getElementsByTagName("input");
            var limit = "{{ $question->max }}";
            for (var i = 0; i < checkboxgroup.length; i++) {
                checkboxgroup[i].onclick = function() {
                    var checkedcount = 0;
                    for (var i = 0; i < checkboxgroup.length; i++) {
                        checkedcount += (checkboxgroup[i].checked) ? 1 : 0;
                    }
                    if (checkedcount > limit) {
                        console.log("You can select maximum of " + limit + " checkbox.");
                        alert("You can select maximum of " + limit + " checkbox.");
                        this.checked = false;
                    }
                }
            }
        </script>
    @endif
@endcomponent
