@php
    $time = now();
@endphp

<div>
    <div class="flex flex-col col-span-full bg-white shadow-lg rounded-sm border border-slate-200">
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
                        <div class="mb-2">Hey <strong
                                class="font-medium text-slate-800">{{ tenant()->company }}</strong> 👋, the average mood
                            levels for
                            the {{ $filter }} is at:</div>
                        <div class="text-3xl font-bold text-emerald-500">{{ $average }}%</div>
                    </div>
                </div>
                <!-- Right side -->
                {{-- <ul class="shrink-0 flex flex-wrap justify-end md:justify-start -space-x-3 -ml-px">
                    <li>
                        <a class="block" href="#0">
                            <img class="w-9 h-9 rounded-full" src="{{ asset('images/company-icon-01.svg') }}"
                                width="36" height="36" alt="Account 01" />
                        </a>
                    </li>
                    <li>
                        <a class="block" href="#0">
                            <img class="w-9 h-9 rounded-full" src="{{ asset('images/company-icon-02.svg') }}"
                                width="36" height="36" alt="Account 02" />
                        </a>
                    </li>
                    <li>
                        <a class="block" href="#0">
                            <img class="w-9 h-9 rounded-full" src="{{ asset('images/company-icon-03.svg') }}"
                                width="36" height="36" alt="Account 03" />
                        </a>
                    </li>
                    <li>
                        <a class="block" href="#0">
                            <img class="w-9 h-9 rounded-full" src="{{ asset('images/company-icon-04.svg') }}"
                                width="36" height="36" alt="Account 04" />
                        </a>
                    </li>
                </ul> --}}
            </div>
        </div>
    </div>

    <div class="flex flex-col col-span-full row-span-6 bg-white shadow-lg rounded-sm border border-slate-200"
        wire:key="{{ $filter }}.{{ $selectedId }}.{{ $time }}.{{ now() }}">
        <header class="px-5 py-4 flex items-center">
            <h2 class="font-semibold text-slate-800">Mood Tracker
                ({{ \Carbon\Carbon::now()->startOfMonth()->format('M d') }} –
                {{ \Carbon\Carbon::now()->endOfMonth()->format('M d') }})</h2>
        </header>

        <div>
            {{-- <ul class="flex flex-wrap ml-6">
                <li style="margin-right: 16px;"><button style="display: inline-flex; align-items: center;"><span
                            style="display: block; width: 12px; height: 12px; border-radius: 9999px; margin-right: 8px; border-width: 3px; border-color: rgb(96, 165, 250); pointer-events: none;"></span><span
                            style="display: flex; align-items: center;"><span class="text-slate-800 "
                                style="font-size: 1.35rem; line-height: 1.33; font-weight: 700; margin-right: 8px; pointer-events: none;">MIN</span><span
                                class="text-slate-400" style="font-size: 0.875rem; line-height: 1.5715;">Most
                                answered</span></span></button></li>
                <li style="margin-right: 16px;"><button style="display: inline-flex; align-items: center;"><span
                            style="display: block; width: 12px; height: 12px; border-radius: 9999px; margin-right: 8px; border-width: 3px; border-color: rgb(99, 102, 241); pointer-events: none;"></span><span
                            style="display: flex; align-items: center;"><span class="text-slate-800"
                                style="font-size: 1.35rem; line-height: 1.33; font-weight: 700; margin-right: 8px; pointer-events: none;">MAX</span><span
                                class="text-slate-400" style="font-size: 0.875rem; line-height: 1.5715;">Least
                                answered</span></span></button></li>
            </ul> --}}
            <div class="grow">
                <canvas id="{{ $filter }}-{{ $selectedId }}-{{ $time }}" class="p-4 w-full"></canvas>
            </div>
        </div>

        <script>
            let data = @js($fetchedData);
            let labels = Object.keys(data)
            let dataset = Object.values(data)

            let options = {
                layout: {
                    padding: {
                        top: 12,
                        bottom: 16,
                        left: 20,
                        right: 20,
                    },
                },

                plugins: {
                    legend: {
                        display: false
                    }
                },
                scale: {
                    ticks: {
                        precision: 0
                    }
                },
                legend: {
                    display: false
                },
                title: {
                    display: false,
                },
                scales: {
                    y: {
                        border: {
                            display: false,
                        },
                        ticks: {
                            maxTicksLimit: 10,
                        },
                        max: 100,
                        min: 0,
                    },
                },
                responsive: true
            };

            backgroundColor = [
                "rgb(129 140 248)"
            ];
            var chkReadyState = setInterval(function() {
                if (document.readyState == "complete") {
                    try {
                        new Chart(document.getElementById(
                            "{{ $filter }}-{{ $selectedId }}-{{ $time }}"), {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Mood',
                                    backgroundColor: backgroundColor,
                                    data: dataset,
                                }],
                            },
                            options: options,
                        });
                    } catch (error) {
                        // no-op
                    }
                }
            }, 100);
        </script>
    </div>

    @if ($recommendationTitle && count($recommendations) > 0)
        <div class="flex flex-col mt-4 col-span-full bg-white shadow-lg rounded-sm border border-slate-200">
            <div class="px-5 py-6">
                <div class="md:flex md:justify-between md:items-center">
                    <!-- Left side -->
                    <div class="flex items-center mb-4 md:mb-0">

                        <div>
                            <div class="mb-2">Your employee has a <strong
                                    class="font-medium text-slate-800">{{ $recommendationTitle }}</strong> based on
                                their latest
                                mental health survey.</div>
                            <br>
                            <div class="text-3xl font-bold text-indigo-500">View our recommendations below.</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-2 mt-2">
            @foreach ($recommendations as $title => $recommendation)
                <div
                    class="flex flex-col col-span-full xl:col-span-4 row-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                    <header class="px-5 py-4 flex items-center">
                        <h2 class="font-bold text-slate-800 text-2xl">{{ $title }}</h2>
                    </header>

                    <p class="p-4 ">{{ $recommendation }}</p>
                </div>
            @endforeach
        </div>
    @endif


</div>
