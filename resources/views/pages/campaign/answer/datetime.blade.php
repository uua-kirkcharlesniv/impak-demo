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
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500" href="#">1</a>
                                </li>
                                <li>
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-indigo-500 text-white" href="#">2</a>
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

                    <h1 class="text-3xl text-slate-800 font-bold">When was the last time you remembered to relax? 🛁</h1>
                    <p class="text-sm text-slate-400 mt-2 mb-6">We understand this might be a personal question, but we promise we won't judge!</p>
                    <!-- Form -->
                    <form>
                        <div class="space-y-3 mb-6">
                            <div>
                                <!-- Start -->
                                <div class="relative mb-4">
                                    <input class="datepicker form-input pl-9 text-slate-500 hover:text-slate-600 font-medium focus:border-slate-300 w-160" placeholder="Select dates" />
                                    <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 fill-current text-slate-500 ml-3" viewBox="0 0 16 16">
                                            <path d="M15 2h-2V0h-2v2H9V0H7v2H5V0H3v2H1a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V3a1 1 0 00-1-1zm-1 12H2V6h12v8z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="relative">
                                    <input class="timepicker form-input pl-9 text-slate-500 hover:text-slate-600 font-medium focus:border-slate-300 w-160" placeholder="Select time" />
                                    <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                        <i class="fa-solid fa-clock w-4 h-4 fill-current text-slate-500 ml-3"></i>                                    </div>
                                </div>
                                <!-- End -->
                            </div>                   
                        </div>
                        <div class="flex items-center justify-between">
                            <a class="btn bg-indigo-500 hover:bg-indigo-600 text-white ml-auto" href="/survey/1/3">Next -&gt;</a>
                        </div>
                    </form>
                  
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
