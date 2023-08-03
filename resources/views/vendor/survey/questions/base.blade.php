<div class="w-full rounded-lg">
    <label class="text-lg font-bold tracking-tight text-gray-900" for="{{ $question->key }}">
        {{ $question->content }}
        @if ($question->is_required)
            <span class="text-red-800"><b>*</b></span>
        @endif
    </label>

    <div class="mt-2">
        {{ $slot }}
    </div>

    @if ($errors->has($question->key))
        <div class="text-red-500 mt-3">{{ $errors->first($question->key) }}</div>
    @endif

    <div class="text-green-500">
        {{ $report ?? '' }}
    </div>


    <script defer="defer">
        // Function to handle checkbox changes for a specific question
        function handleQuestionCheckboxChange(questionKey, limit) {
            var checkboxes = document.querySelectorAll('input[name="' + questionKey + '[]"]');
            var checkedCount = 0;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    checkedCount++;
                }
            });

            checkboxes.forEach(function(checkbox) {
                checkbox.disabled = checkedCount >= limit && !checkbox.checked;
            });
        }

        // Function to attach event listeners to the checkboxes
        function attachCheckboxListeners() {
            var checkboxGroups = document.querySelectorAll('[id^="checkboxgroup-"]');

            checkboxGroups.forEach(function(group) {
                var questionKey = group.id.split('-')[1];
                var limit = parseInt(group.dataset.limit);

                var checkboxes = group.querySelectorAll('input[type="checkbox"]');

                checkboxes.forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        handleQuestionCheckboxChange(questionKey, limit);
                    });
                });

                // Handle initial checkbox state
                handleQuestionCheckboxChange(questionKey, limit);
            });
        }

        // Call the function to attach event listeners
        attachCheckboxListeners();
    </script>
</div>
