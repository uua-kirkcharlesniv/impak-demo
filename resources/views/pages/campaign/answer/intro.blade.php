<x-app-layout>
    <!-- Content -->
    <div class="w-full">

        <div class="min-h-screen h-full flex flex-col after:flex-1">

            {{-- <div class="flex-1">

                <!-- Progress bar -->
                <div class="px-4 pt-12">
                    <div class="max-w-md mx-auto w-full">
                        <div class="relative">
                            <div class="absolute left-0 top-1/2 -mt-px w-full h-0.5 bg-slate-200" aria-hidden="true">
                            </div>
                            <ul class="relative flex justify-between w-full">
                                <li>
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500"
                                        href="#">1</a>
                                </li>
                                <li>
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500"
                                        href="#">2</a>
                                </li>
                                <li>
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500"
                                        href="#">3</a>
                                </li>
                                <li>
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500"
                                        href="#">4</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
            <livewire:survey-answer-page :survey="$survey" />
            {{-- <form action="{{ route('survey.process', $survey->id) }}" method="POST">
                @csrf
                @include('survey::standard', ['survey' => $survey])
            </form> --}}

            {{-- <div class="flex-1 px-4 ">
                <div class="max-w-md mx-auto">

                    <h1 class="text-3xl text-slate-800 font-bold">Reminders ‼️</h1>
                    <p class="text-sm text-slate-400 mb-6">Quick reminders before we start.</p>
                    <!-- Form -->
                    <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                        <li class="flex items-center mb-2">
                            <svg class="w-4 h-4 mr-5 text-green-500 dark:text-green-400 flex-shrink-0"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Please answer all questions honestly and to the best of your knowledge.
                        </li>
                        <li class="flex items-center mb-2">
                            <svg class="w-4 h-4 mr-5 text-green-500 dark:text-green-400 flex-shrink-0"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Your responses will be kept confidential and anonymous.
                        </li>
                        <li class="flex items-center mb-2">
                            <svg class="w-4 h-4 mr-5 text-green-500 dark:text-green-400 flex-shrink-0"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Please ensure that you are in a quiet and distraction-free environment before beginning the survey.
                        </li>
                        <li class="flex items-center mb-2">
                            <svg class="w-4 h-4 mr-5 text-green-500 dark:text-green-400 flex-shrink-0"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Please read each question carefully before answering.
                        </li>
                        <li class="flex items-center mb-6">
                            <svg class="w-4 h-4 mr-5 text-gray-400 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            You must not exceed 25 minutes answering this survey.
                        </li>
                        <div class="flex items-center justify-between" x-data="{ bgClass: 'bg-gray-500 hover:bg-gray-600' }"  x-init="setTimeout(() => bgClass = 'bg-indigo-500 hover:bg-indigo-600', 5000)">
                            <a :class="bgClass + ' btn text-white ml-auto'" href="/survey/1/1">Let's go!</a>
                        </div>
                    </ul>

                </div>
            </div> --}}

        </div>

    </div>
</x-app-layout>
