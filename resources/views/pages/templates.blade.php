<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Frameworks ✨</h1>
                <p class="text-sm text-gray-400">Choose from our science-backed frameworks to unleash the full potential
                    <br>
                    of your surveys and elevate
                    your data-driven decision-making.
                </p>
            </div>

        </div>

        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">

            <!-- Campaign cards -->
            @foreach ($templates as $campaign)
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
                        default:
                            $bgColor = 'bg-gray-200';
                            $textColor = 'text-black';
                            $photo = 'https://unsplash.com/photos/F2KRf_QfCqw/download?ixid=M3wxMjA3fDB8MXxzZWFyY2h8M3x8ZXZlbnR8ZW58MHx8fHwxNjkyNjMwNTcyfDA&force=true&w=640';
                    }
                @endphp

                <div
                    class="col-span-full sm:col-span-6 xl:col-span-4 bg-white border border-gray-200 rounded-lg shadow ">
                    <a href="#">
                        <img class="rounded-t-lg h-40 w-full object-cover" src="{{ $photo }}" alt="" />
                    </a>
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                            {{ $campaign->rationale }}
                        </h5>
                        <div>

                            <span
                                class="inline-block {{ $bgColor }}  {{ $textColor }} rounded-full px-3 py-1 text-sm font-semibold mr-2 mb-2">
                                {{ ucwords(strtolower(str_replace('_', ' ', $campaign->survey_type))) }}
                            </span>
                        </div>
                        <p class="mb-3 font-normal text-gray-700 text-ellipsis">
                            {{ \Illuminate\Support\Str::limit($campaign->rationale_description, 200, $end = '...') }}
                        </p>
                        <a href="{{ route('template.use', $campaign->id) }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Use
                            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>


    </div>
</x-app-layout>
