<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="mb-8">

            <!-- Title -->
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Account Settings ✨</h1>

        </div>

        <div class="bg-white shadow-lg rounded-sm mb-8">
            <div class="flex flex-col md:flex-row md:-mr-px">

                <!-- Sidebar -->
                <x-settings.settings-sidebar />

                <!-- Panel -->
                {{-- <x-settings.plans-panel /> --}}
                <div class="grow">

                    <!-- Panel body -->
                    <div class="p-6 space-y-6">
                
                        <!-- Plans -->
                        <section>
                            <div class="mb-8">
                                <h2 class="text-2xl text-slate-800 font-bold mb-4">Plans</h2>
                                {{-- <div class="text-sm">This workspace’s Basic Plan is set to <strong class="font-medium">$34</strong> per month and will renew on <strong class="font-medium">July 9, 2021</strong>.</div> --}}
                            </div>
                
                            <!-- Pricing -->
                            <div x-data="{ annual: false }">
                                <!-- Toggle switch -->
                                <div class="flex items-center space-x-3 mb-6">
                                    <div class="text-sm text-slate-500 font-medium">Monthly</div>
                                    <div class="form-switch">
                                        <input type="checkbox" id="toggle" class="sr-only" x-model="annual" />
                                        <label class="bg-slate-400" for="toggle">
                                            <span class="bg-white shadow-sm" aria-hidden="true"></span>
                                            <span class="sr-only">Pay annually</span>
                                        </label>
                                    </div>
                                    <div class="text-sm text-slate-500 font-medium">Annually <span class="text-emerald-500">(-20%)</span></div>
                                </div>
                                <!-- Pricing tabs -->
                                <div class="grid grid-cols-12 gap-6">
                                    <!-- Tab 1 -->
                                    <div class="relative col-span-full xl:col-span-4 bg-white shadow-md rounded-sm border border-slate-200">
                                        <div class="absolute top-0 left-0 right-0 h-0.5 bg-emerald-500" aria-hidden="true"></div>
                                        <div class="px-5 pt-5 pb-6 border-b border-slate-200">
                                            <header class="flex items-center mb-2">
                                                <div class="w-6 h-6 rounded-full shrink-0 bg-gradient-to-tr from-emerald-500 to-emerald-300 mr-3">
                                                    <svg class="w-6 h-6 fill-current text-white" viewBox="0 0 24 24">
                                                        <path d="M12 17a.833.833 0 01-.833-.833 3.333 3.333 0 00-3.334-3.334.833.833 0 110-1.666 3.333 3.333 0 003.334-3.334.833.833 0 111.666 0 3.333 3.333 0 003.334 3.334.833.833 0 110 1.666 3.333 3.333 0 00-3.334 3.334c0 .46-.373.833-.833.833z" />
                                                    </svg>
                                                </div>
                                                <h3 class="text-lg text-slate-800 font-semibold">Basic</h3>
                                            </header>
                                            <div class="text-sm mb-2">Ideal for individuals that need a custom solution with custom tools.</div>
                                            <!-- Price -->
                                            <div class="text-slate-800 font-bold mb-4">
                                                <span class="text-2xl">$</span><span class="text-3xl" x-text="annual ? '50' : '5'">10</span><span class="text-slate-500 font-medium text-sm">/mo</span>
                                            </div>
                                            <!-- CTA -->
                                            
                                            @if(auth()->user()->subscribed('basic'))
                                                <button class="btn border-slate-200 bg-slate-100 text-slate-400 w-full cursor-not-allowed flex items-center" disabled>
                                                    <svg class="w-3 h-3 shrink-0 fill-current mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <span>Current Plan</span>
                                                </button>
                                            @else
                                                @if(Auth::user()->subscriptions()->active()->get()->count() > 0)
                                                    <button class="btn border-slate-200 hover:border-slate-300 text-slate-600 w-full">Downgrade</button>
                                                @else
                                                    <x-paddle-button :url="$basicPaylink" class="btn bg-indigo-500 hover:bg-indigo-600 text-white w-full" data-theme="none">
                                                        Subscribe
                                                    </x-paddle-button>
                                                @endif
                                            @endif

                                        </div>
                                        <div class="px-5 pt-4 pb-5">
                                            <div class="text-xs text-slate-800 font-semibold uppercase mb-4">What's included</div>
                                            <!-- List -->
                                            <ul>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Lorem ipsum dolor sit amet</div>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Quis nostrud exercitation</div>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Lorem ipsum dolor sit amet</div>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Quis nostrud exercitation</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Tab 2 -->
                                    <div class="relative col-span-full xl:col-span-4 bg-white shadow-md rounded-sm border border-slate-200">
                                        <div class="absolute top-0 left-0 right-0 h-0.5 bg-sky-500" aria-hidden="true"></div>
                                        <div class="px-5 pt-5 pb-6 border-b border-slate-200">
                                            <header class="flex items-center mb-2">
                                                <div class="w-6 h-6 rounded-full shrink-0 bg-gradient-to-tr from-sky-500 to-sky-300 mr-3">
                                                    <svg class="w-6 h-6 fill-current text-white" viewBox="0 0 24 24">
                                                        <path d="M12 17a.833.833 0 01-.833-.833 3.333 3.333 0 00-3.334-3.334.833.833 0 110-1.666 3.333 3.333 0 003.334-3.334.833.833 0 111.666 0 3.333 3.333 0 003.334 3.334.833.833 0 110 1.666 3.333 3.333 0 00-3.334 3.334c0 .46-.373.833-.833.833z" />
                                                    </svg>
                                                </div>
                                                <h3 class="text-lg text-slate-800 font-semibold">Pro</h3>
                                            </header>
                                            <div class="text-sm mb-2">Ideal for individuals that need a custom solution with custom tools.</div>
                                            <!-- Price -->
                                            <div class="text-slate-800 font-bold mb-4">
                                                <span class="text-2xl">$</span><span class="text-3xl" x-text="annual ? '100' : '10'">10</span><span class="text-slate-500 font-medium text-sm">/mo</span>
                                            </div>
                                            <!-- CTA -->
                                            @if(auth()->user()->subscribed('pro'))
                                                <button class="btn border-slate-200 bg-slate-100 text-slate-400 w-full cursor-not-allowed flex items-center" disabled>
                                                    <svg class="w-3 h-3 shrink-0 fill-current mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <span>Current Plan</span>
                                                </button>
                                            @else
                                                @if(Auth::user()->subscriptions()->active()->get()->count() > 0)
                                                    @if(auth()->user()->subscribed('basic'))
                                                        <button class="btn border-slate-200 hover:border-slate-300 text-slate-600 w-full">Upgrade</button>
                                                    @elseif(auth()->user()->subscribed('enterprise'))
                                                        <button class="btn border-slate-200 hover:border-slate-300 text-slate-600 w-full">Downgrade</button>
                                                    @endif
                                                @else
                                                    <x-paddle-button :url="$proPaylink" class="btn bg-indigo-500 hover:bg-indigo-600 text-white w-full" data-theme="none">
                                                        Subscribe
                                                    </x-paddle-button>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="px-5 pt-4 pb-5">
                                            <div class="text-xs text-slate-800 font-semibold uppercase mb-4">What's included</div>
                                            <!-- List -->
                                            <ul>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Lorem ipsum dolor sit amet</div>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Quis nostrud exercitation</div>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Lorem ipsum dolor sit amet</div>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Quis nostrud exercitation</div>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Lorem ipsum dolor sit amet</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Tab 3 -->
                                    <div class="relative col-span-full xl:col-span-4 bg-white shadow-md rounded-sm border border-slate-200">
                                        <div class="absolute top-0 left-0 right-0 h-0.5 bg-indigo-500" aria-hidden="true"></div>
                                        <div class="px-5 pt-5 pb-6 border-b border-slate-200">
                                            <header class="flex items-center mb-2">
                                                <div class="w-6 h-6 rounded-full shrink-0 bg-gradient-to-tr from-indigo-500 to-indigo-300 mr-3">
                                                    <svg class="w-6 h-6 fill-current text-white" viewBox="0 0 24 24">
                                                        <path d="M12 17a.833.833 0 01-.833-.833 3.333 3.333 0 00-3.334-3.334.833.833 0 110-1.666 3.333 3.333 0 003.334-3.334.833.833 0 111.666 0 3.333 3.333 0 003.334 3.334.833.833 0 110 1.666 3.333 3.333 0 00-3.334 3.334c0 .46-.373.833-.833.833z" />
                                                    </svg>
                                                </div>
                                                <h3 class="text-lg text-slate-800 font-semibold">Plus</h3>
                                            </header>
                                            <div class="text-sm mb-2">Ideal for individuals that need a custom solution with custom tools.</div>
                                            <!-- Price -->
                                            <div class="text-slate-800 font-bold mb-4">
                                                <span class="text-2xl">$</span><span class="text-3xl" x-text="annual ? '200' : '20'">74</span><span class="text-slate-500 font-medium text-sm">/mo</span>
                                            </div>
                                            <!-- CTA -->
                                            {{-- <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white w-full">Upgrade</button> --}}
                                            @if(auth()->user()->subscribed('pro'))
                                                <button class="btn border-slate-200 bg-slate-100 text-slate-400 w-full cursor-not-allowed flex items-center" disabled>
                                                    <svg class="w-3 h-3 shrink-0 fill-current mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <span>Current Plan</span>
                                                </button>
                                            @else
                                                @if(Auth::user()->subscriptions()->active()->get()->count() > 0)
                                                    <button class="btn border-slate-200 hover:border-slate-300 text-slate-600 w-full">Upgrade</button>
                                                @else
                                                    <x-paddle-button :url="$enterprisePaylink" class="btn bg-indigo-500 hover:bg-indigo-600 text-white w-full" data-theme="none">
                                                        Subscribe
                                                    </x-paddle-button>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="px-5 pt-4 pb-5">
                                            <div class="text-xs text-slate-800 font-semibold uppercase mb-4">What's included</div>
                                            <!-- List -->
                                            <ul>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Lorem ipsum dolor sit amet</div>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Quis nostrud exercitation</div>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Lorem ipsum dolor sit amet</div>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Quis nostrud exercitation</div>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Lorem ipsum dolor sit amet</div>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                                                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                                                    </svg>
                                                    <div class="text-sm">Quis nostrud exercitation</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                
                        <!-- Contact Sales -->
                        <section>
                            <div class="px-5 py-3 bg-indigo-50 border border-indigo-100 rounded-sm text-center xl:text-left xl:flex xl:flex-wrap xl:justify-between xl:items-center">
                                <div class="text-slate-800 font-semibold mb-2 xl:mb-0">Looking for different configurations?</div>
                                <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white">Contact Sales</button>
                            </div>
                        </section>
                
                        <!-- FAQs -->
                        <section>
                            <div class="my-8">
                                <h2 class="text-2xl text-slate-800 font-bold">FAQs</h2>
                            </div>
                            <ul class="space-y-5">
                                <li>
                                    <div class="font-semibold text-slate-800 mb-1">
                                        What is the difference between the three versions?
                                    </div>
                                    <div class="text-sm">
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.
                                    </div>
                                </li>
                                <li>
                                    <div class="font-semibold text-slate-800 mb-1">
                                        Is there any difference between Basic and Enterprise licenses?
                                    </div>
                                    <div class="text-sm">
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    </div>
                                </li>
                                <li>
                                    <div class="font-semibold text-slate-800 mb-1">
                                        Got more questions?
                                    </div>
                                    <div class="text-sm">
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum in voluptate velit esse cillum dolore eu fugiat <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">contact us</a>.
                                    </div>
                                </li>
                            </ul>
                        </section>
                        
                    </div>
                
                    <!-- Panel footer -->
                    <footer>
                        <div class="flex flex-col px-6 py-5 border-t border-slate-200">
                            <div class="flex self-end">
                                <button class="btn border-slate-200 hover:border-slate-300 text-slate-600">Cancel</button>
                                <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white ml-3">Save Changes</button>
                            </div>
                        </div>
                    </footer>
                
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
