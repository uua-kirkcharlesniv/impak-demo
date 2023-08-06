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
                <div
                    class="col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                    <div class="flex flex-col h-full p-5">
                        <header>
                            <div class="flex items-center justify-between">

                            </div>
                        </header>
                        <div class="grow mt-2">
                            <a class="inline-flex text-slate-800 hover:text-slate-900 mb-1" href="#0">
                                <h2 class="text-xl leading-snug font-semibold">{{ $campaign->title }}</h2>
                            </a>
                            <div class="text-sm">{{ $campaign->rationale_description }}</div>
                        </div>
                        <footer class="mt-5">


                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="text-xs inline-flex font-medium rounded-full text-center px-2.5 py-1 ">
                                        {{ $campaign->rationale }}</div>
                                </div>
                                <div>
                                    <a class="text-sm font-medium text-indigo-500 hover:text-indigo-600"
                                        href="{{ route('template.use', $campaign->id) }}">Use
                                        -&gt;</a>

                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
            @endforeach

        </div>


    </div>
</x-app-layout>
