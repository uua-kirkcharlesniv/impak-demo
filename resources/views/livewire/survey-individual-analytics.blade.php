<div wire:poll.30s.visible="refreshData">
    <div class="flex flex-col col-span-full bg-white shadow-lg rounded-sm border border-slate-200"
        wire:key="analytics-survey-{{ $survey->id }}">
        <div class="px-5 py-6">
            <div class="md:flex md:justify-between md:items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <div>
                        <strong class="text-slate-800 font-xl text-3xl"> {{ $survey->name }}</strong>
                    </div>
                </div>
                <div class="text-3xl font-bold text-emerald-500">{{ $survey->completion_percent * 100 }}%</div>
            </div>
            <div class="w-full h-4 my-4 mb-4 bg-gray-200 rounded-full dark:bg-gray-700">
                <div class="h-4 bg-blue-600 rounded-full dark:bg-blue-500"
                    style="width: {{ $survey->completion_percent * 100 }}%"></div>
            </div>
            <div class="rounded-sm">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full divide-y divide-slate-200">
                        <tbody class="text-sm" x-data="{ open: false }">
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
            <div class="grid grid-cols-12 gap-6 mt-4">
                @foreach ($section->questions as $questionIndex => $question)
                    <div
                        class="flex flex-col col-span-full xl:col-span-{{ $rowSpans[$sectionIndex][$questionIndex] }} row-span-6 bg-white shadow-lg rounded-sm border border-slate-200">
                        <header class="border-l-8 border-red-500 bg-slate-200 font-bold p-4 text-black"
                            style="border-color: #{{ substr(md5($section->id), 0, 6) }}">
                            {{ $section->name }}
                        </header>
                        <header class="px-5 py-4 flex items-center">
                            <h2 class="font-semibold text-slate-800">{{ $question->content }}</h2>
                        </header>

                        <livewire:survey-question-chart :sectionIndex="$sectionIndex" :questionIndex="$questionIndex" :question="$question"
                            wire:key="{{ $survey->id }}.{{ $section->id }}.{{ $question->id }}.{{ now() }}" />
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
