@php
    switch ($campaign->survey_type) {
        case 'post_event':
            $bgColor = 'bg-amber-400';
            $textColor = 'text-black';
            $photo = 'https://unsplash.com/photos/F2KRf_QfCqw/download?ixid=M3wxMjA3fDB8MXxzZWFyY2h8M3x8ZXZlbnR8ZW58MHx8fHwxNjkyNjMwNTcyfDA&force=true&w=640';
            break;
        case 'post_workshop':
            $bgColor = 'bg-sky-400';
            $textColor = 'text-black';
            $photo = 'https://plus.unsplash.com/premium_photo-1661713210744-f5be3c3491fe?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80';
            break;

        case 'mental_health':
            $bgColor = 'bg-blue-400';
            $textColor = 'text-white';
            $photo = 'https://unsplash.com/photos/uGP_6CAD-14/download?ixid=M3wxMjA3fDB8MXxzZWFyY2h8Mnx8aGFwcHklMjBmZWVsaW5nfGVufDB8fHx8MTY5OTU2ODQ5MHww&force=true&w=640';
            break;

        default:
            $bgColor = 'bg-gray-200';
            $textColor = 'text-black';
            $photo = 'https://unsplash.com/photos/F2KRf_QfCqw/download?ixid=M3wxMjA3fDB8MXxzZWFyY2h8M3x8ZXZlbnR8ZW58MHx8fHwxNjkyNjMwNTcyfDA&force=true&w=640';
    }
@endphp

<div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white border border-gray-200 rounded-lg shadow ">
    <a href="#">
        <img class="rounded-t-lg h-40 w-full object-cover" src="{{ $photo }}" alt="" />
    </a>
    <div class="p-5">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
            {{ $campaign->name }}
        </h5>
        <div>
            <span
                class="inline-block {{ $bgColor }}  {{ $textColor }} rounded-full px-3 py-1 text-sm font-semibold mr-2 mb-2">
                {{ ucwords(strtolower(str_replace('_', ' ', $campaign->survey_type))) }}
            </span>
        </div>
        <p class="mb-3 font-normal text-gray-700 text-ellipsis">
            {{ \Illuminate\Support\Str::limit($campaign->rationale_description, 100, $end = '...') }}
        </p>

        @if (Auth::user()->hasPermissionTo('manage-employees'))
            <a href="{{ route('survey.edit', $campaign->id) }}"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                Edit
                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        @else
            @if ($campaign->is_open && $campaign->isEligible(Auth::user()))
                <a href="{{ route('survey.view', $campaign->id) }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                    Answer
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
                @if ($campaign->end_time != null)
                    <br>
                    <span class="text-slate-400">
                        Closes at {{ \Carbon\Carbon::parse($campaign->end_time)->format('h:i A') }}.
                    </span>
                @endif
            @else
                <a href="#"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                    Closed
                </a>
                <div class="text-sm font-medium text-slate-500 mb-2">
                    @if ($campaign->recurrent_days != null)
                        @php
                            $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                            $recurrentDays = $campaign->recurrent_days ?? [];
                            $recurrentDays = array_map(fn($day) => $daysOfWeek[$day], $recurrentDays);
                            $daysList = implode(', ', $recurrentDays);
                        @endphp
                        <br>
                        <span class="text-slate-400">
                            <span class="text-slate-400">Form is open for submission every: {{ $daysList }}.</span>
                        </span>
                    @endif
                    @if ($campaign->start_time != null)
                        <br>
                        <span class="text-slate-400">
                            Opens at {{ \Carbon\Carbon::parse($campaign->start_time)->format('h:i A') }}.
                        </span>
                    @endif
                </div>
            @endif
        @endif
    </div>
</div>
