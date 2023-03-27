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
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500" href="#">2</a>
                                </li>
                                <li>
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-slate-100 text-slate-500" href="#">2</a>
                                </li>
                                <li>
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-indigo-500 text-white" href="#">4</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 px-4 ">
                <div class="max-w-md mx-auto">

                    <h1 class="text-3xl text-slate-800 font-bold">Send us a pic of what keeps you moving! 📸</h1>
                    <p class="text-sm text-slate-400 mt-2 mb-6">Share a pic of your furry best friend, favorite food, or special place that motivates and inspires you!</p>
                    <!-- Form -->
                    <form>
                        <div class="space-y-3 mb-6">
                            <article aria-label="File Upload Modal" class="relative h-full flex flex-col bg-white shadow-xl rounded-md" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);" ondragenter="dragEnterHandler(event);">

                      
                                <!-- scroll area -->
                                <section class="h-full overflow-auto p-8 w-full h-full flex flex-col">
                                  <header class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                                    <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                                      <span>Drag and drop your</span>&nbsp;<span>files anywhere or</span>
                                    </p>
                                    <input id="hidden-input" type="file" multiple class="hidden" />
                                    <button id="button" class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                                      Upload a file
                                    </button>
                                  </header>
                              </article>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <a class="btn bg-indigo-500 hover:bg-indigo-600 text-white ml-auto" href="/survey/1/completed">Submit! -&gt;</a>
                        </div>
                    </form>
                  
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
