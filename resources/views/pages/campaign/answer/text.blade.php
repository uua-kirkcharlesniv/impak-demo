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
                                    <a class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold bg-indigo-500 text-white" href="#">3</a>
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

                    <h1 class="text-3xl text-slate-800 font-bold">What's your favorite way to unwind after a long day? 🥱</h1>
                    <p class="text-sm text-slate-400 mt-2 mb-6">We all have those days that leave us feeling drained. Whether it's a tough day at work or a hectic day at home, it's important to have some downtime to unwind and recharge.</p>
                    <!-- Form -->
                    <form>
                        <div class="space-y-3 mb-6">
                            <div>
                                <label class="block text-sm font-medium mb-1" for="normal">A short answer will suffice 👀</label>
                                <input id="normal" class="form-input w-full" type="text" placeholder="Catching up with friends is what I normally do!" />
                            </div> 
                            <div class="inline-flex items-center justify-center w-full">
                                <hr class="w-64 h-px my-8 bg-gray-400 border-0">
                                <span class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-slate-100 left-1/2">or answer longer</span>
                            </div>
                            <textarea id="normal" class="form-input w-full" type="text" placeholder="... or going out and enjoying a film."></textarea>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <a class="btn bg-indigo-500 hover:bg-indigo-600 text-white ml-auto" href="/survey/1/4">Next -&gt;</a>
                        </div>
                    </form>
                  
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
