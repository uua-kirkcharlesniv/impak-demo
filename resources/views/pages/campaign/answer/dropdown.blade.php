<x-app-layout>
      <!-- Content -->
      <div class="w-full">

        <div class="min-h-screen h-full flex flex-col after:flex-1">

            <div class="flex-1">

                <!-- Progress bar -->
                <div class="px-4 pt-12">
                    <div class="max-w-md mx-auto w-full">
                        <div class="relative">
                            <div class="absolute left-0 top-1/2 -mt-px w-full h-0.5 bg-slate-200" aria-hidden="true"></div>
                            <ul class="relative flex justify-between w-full">
                                <li>
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-indigo-500 text-white" href="#">1</a>
                                </li>
                                <li>
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500" href="#">2</a>
                                </li>
                                <li>
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500" href="#">3</a>
                                </li>
                                <li>
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500" href="#">4</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 px-4 ">
                <div class="max-w-md mx-auto">

                    <h1 class="text-3xl text-slate-800 font-bold">How often do you shower in remote work setting? 🤔</h1>
                    <p class="text-sm text-slate-400 mb-6">Your answer is between us only 🤫. <span class="text-indigo-500">Choose one only.</span> </p>
                    <!-- Form -->
                    <form>
                        <div class="space-y-3">
                            <label class="relative block cursor-pointer">
                                <input type="radio" name="radio-buttons" class="peer sr-only" checked />
                                <div class="flex items-center bg-white text-sm font-medium text-slate-800 p-4 rounded border border-slate-200 hover:border-slate-300 shadow-sm duration-150 ease-in-out">
                                    <span class="text-2xl w-7 h-7 mr-4 ">🔥</span>
                                    <span>At least twice a day</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-indigo-400 rounded pointer-events-none" aria-hidden="true"></div>
                            </label>
                            <label class="relative block cursor-pointer">
                                <input type="radio" name="radio-buttons" class="peer sr-only" />
                                <div class="flex items-center bg-white text-sm font-medium text-slate-800 p-4 rounded border border-slate-200 hover:border-slate-300 shadow-sm duration-150 ease-in-out">
                                    <span class="text-2xl w-7 h-7 mr-4 ">🙂</span>
                                    <span>Once a day</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-indigo-400 rounded pointer-events-none" aria-hidden="true"></div>
                            </label>
                            <label class="relative block cursor-pointer">
                                <input type="radio" name="radio-buttons" class="peer sr-only" />
                                <div class="flex items-center bg-white text-sm font-medium text-slate-800 p-4 rounded border border-slate-200 hover:border-slate-300 shadow-sm duration-150 ease-in-out">
                                    <span class="text-2xl w-7 h-7 mr-4 ">💩</span>
                                    <span>At least once a week</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-indigo-400 rounded pointer-events-none" aria-hidden="true"></div>
                            </label>
                        </div>
                    </form>
                    <div class="inline-flex items-center justify-center w-full">
                        <hr class="w-64 h-px my-8 bg-gray-400 border-0">
                        <span class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-slate-100 left-1/2">or answer multiple</span>
                    </div>
                    <p class="text-sm text-slate-400 mb-6">Choose whichever applies to you. <span class="text-indigo-500">Choose at least 1 item, no maximum answer.</span></p>

                    <form>
                        <div class="space-y-3 mb-8">
                            <label class="relative block cursor-pointer">
                                <input type="checkbox" name="radio-buttons" class="peer sr-only" />
                                <div class="flex items-center bg-white text-sm font-medium text-slate-800 p-4 rounded border border-slate-200 hover:border-slate-300 shadow-sm duration-150 ease-in-out">
                                    <span class="text-2xl w-7 h-7 mr-4 ">🙂</span>
                                    <span>Whenever I feel like to</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-indigo-400 rounded pointer-events-none" aria-hidden="true"></div>
                            </label>
                            <label class="relative block cursor-pointer">
                                <input type="checkbox" name="radio-buttons" class="peer sr-only" />
                                <div class="flex items-center bg-white text-sm font-medium text-slate-800 p-4 rounded border border-slate-200 hover:border-slate-300 shadow-sm duration-150 ease-in-out">
                                    <span class="text-2xl w-7 h-7 mr-4 ">🔥</span>
                                    <span>Whenever I remember to</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-indigo-400 rounded pointer-events-none" aria-hidden="true"></div>
                            </label>
                            <label class="relative block cursor-pointer">
                                <input type="checkbox" name="radio-buttons" class="peer sr-only" />
                                <div class="flex items-center bg-white text-sm font-medium text-slate-800 p-4 rounded border border-slate-200 hover:border-slate-300 shadow-sm duration-150 ease-in-out">
                                    <span class="text-2xl w-7 h-7 mr-4 ">💩</span>
                                    <span>Whenever it's convenient to me</span>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-indigo-400 rounded pointer-events-none" aria-hidden="true"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <a class="btn bg-indigo-500 hover:bg-indigo-600 text-white ml-auto" href="/survey/1/2">Next -&gt;</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
