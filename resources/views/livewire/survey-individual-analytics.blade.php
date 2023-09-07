<div wire:poll.30s.visible="refreshData">
    <div class="flex flex-col col-span-full bg-white shadow-lg rounded-sm border border-slate-200"
        wire:key="analytics-survey-{{ $survey->id }}">
        <div class="px-5 py-6">
            <div class="md:flex md:justify-between md:items-center">
                <!-- Left side -->
                <div class="flex items-center mb-4 md:mb-0">
                    <!-- Avatar -->
                    {{-- <div class="mr-4">
                        <img class="inline-flex rounded-full" src="{{ asset('images/user-64-14.jpg') }}" width="64"
                            height="64" alt="User" />
                    </div> --}}
                    <!-- User info -->
                    <div>
                        <strong class="text-slate-800 font-xl text-3xl"> {{ $survey->name }}</strong>
                    </div>
                </div>
                <!-- Right side -->
                <div class="text-3xl font-bold text-emerald-500">{{ $survey->completion_percent * 100 }}%</div>
                {{-- <div class="shrink-0 flex flex-wrap justify-end md:justify-start -space-x-3 -ml-px">
                </div> --}}
            </div>
            <div class="w-full h-4 my-4 mb-4 bg-gray-200 rounded-full dark:bg-gray-700">
                <div class="h-4 bg-blue-600 rounded-full dark:bg-blue-500"
                    style="width: {{ $survey->completion_percent * 100 }}%"></div>
            </div>
            <div class="rounded-sm">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full divide-y divide-slate-200">
                        <!-- Table body -->
                        <tbody class="text-sm" x-data="{ open: false }">
                            <!-- Row -->
                            <tr>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="flex justify-center items-center">
                                        <div class="m-auto text-center">
                                            <h1 class="text-slate-600 text-2xl font-bold">
                                                {{ $survey->respondents_count }}
                                            </h1>
                                            <hr class="h-px my-2 bg-gray-200 border-0">
                                            <div>
                                                <i class="fa-solid fa-users"></i>
                                                <span>Respondents</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="flex justify-center items-center">
                                        <div class="m-auto text-center">
                                            <h1 class="text-slate-600 text-2xl font-bold">
                                                {{ $survey->entries()->count() }} </h1>
                                            <hr class="h-px my-2 bg-gray-200 border-0">
                                            <div>
                                                <i class="fa-solid fa-users"></i>
                                                <span>Total Responses</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="flex justify-center items-center">
                                        <div class="m-auto text-center">
                                            <h1 class="text-slate-600 text-2xl font-bold">
                                                {{ $survey->unique_users_entry_count }} </h1>
                                            <hr class="h-px my-2 bg-gray-200 border-0">
                                            <div>
                                                <i class="fa-solid fa-users"></i>
                                                <span>Unique Responses</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                    <div class="flex justify-center items-center">
                                        <div class="m-auto text-center">
                                            <h1 class="text-slate-600 text-xl font-bold">2 minutes</h1>
                                            <hr class="h-px my-2 bg-gray-200 border-0">
                                            <div>
                                                <i class="fa-regular fa-clock"></i>
                                                <span>Average Time</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>


                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @foreach ($survey->sections as $sectionIndex => $section)
        <div class="mt-4 mb-8" wire:key="{{ $section->id }}">
            <h1 class="font-bold text-2xl text-slate-800">{{ $section->name }}</h1>
            <div class="grid grid-cols-12 gap-6 mt-4">
                @foreach ($section->questions as $questionIndex => $question)
                    @php
                        switch ($question->type) {
                            case 'likert':
                                $size = 6;
                                break;
                            case 'range':
                                $size = 12;
                                break;
                            default:
                                $size = 6;
                                break;
                        }
                        
                        if ($sectionIndex == 0 && $questionIndex > 3) {
                            $size = 4;
                        } elseif ($sectionIndex == 1) {
                            $size = 4;
                        }
                        
                        if ($sectionIndex == 1 && $questionIndex > 5) {
                            $size = 6;
                        }
                        
                    @endphp
                    <div
                        class="flex flex-col col-span-full xl:col-span-{{ $size }} row-span-6 bg-white shadow-lg rounded-sm border border-slate-200">
                        <header class="px-5 py-4 flex items-center">
                            <h2 class="font-semibold text-slate-800">{{ $question->content }}</h2>
                        </header>
                        {{-- <div class="px-5 py-1">
                            
                        </div> --}}

                        <livewire:survey-question-chart :sectionIndex="$sectionIndex" :questionIndex="$questionIndex" :question="$question"
                            wire:key="{{ $survey->id }}.{{ $section->id }}.{{ $question->id }}.{{ now() }}" />

                    </div>
                @endforeach

            </div>
        </div>
    @endforeach
</div>
