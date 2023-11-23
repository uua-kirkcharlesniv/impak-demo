@php
    $time = now();
@endphp

<div class="flex flex-col h-full">
    <div class="flex grid lg:grid-cols-5 md:grid-cols-2 sm:grid-cols-1 gap-6">
        <div class="bg-white rounded-b-2xl p-4 border-t-8 border-indigo-200">
            <div class="flex flex-wrap">
                <div class="w-3/5">
                    <h1 class="text-black text-sm font-bold">Mood score this period</h1>
                </div>
                <div class="w-2/5 place-items-center m-auto">
                    <h1 class="text-center font-black text-2xl text-lime-600">52%</h1>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-b-2xl p-4 border-t-8 border-indigo-400">
            <div class="flex flex-wrap">
                <div class="w-3/5">
                    <h1 class="text-black text-sm font-bold">Average mood this period</h1>
                </div>
                <div class="w-2/5 place-items-center m-auto">
                    @svg('happy', 'm-auto')
                </div>
            </div>
        </div>
        <div class="bg-white rounded-b-2xl p-4 border-t-8 border-indigo-600">
            <div class="flex flex-wrap">
                <div class="w-3/5">
                    <h1 class="text-black text-sm font-bold">Recurring mood this period</h1>
                </div>
                <div class="w-2/5 place-items-center m-auto">
                    @svg('neutral', 'm-auto')
                </div>
            </div>
        </div>
        <div class="bg-white rounded-b-2xl p-4 border-t-8 border-amber-400">
            <div class="flex flex-wrap">
                <div class="w-3/5">
                    <h1 class="text-black text-sm font-bold">Average mood this period</h1>
                </div>
                <div class="w-2/5 place-items-center m-auto">
                    @svg('happy', 'm-auto')
                </div>
            </div>
        </div>
        <div class="bg-white rounded-b-2xl p-4 border-t-8 border-amber-600">
            <div class="flex flex-wrap">
                <div class="w-3/5">
                    <h1 class="text-black text-sm font-bold">Average mood this period</h1>
                </div>
                <div class="w-2/5 place-items-center m-auto">
                    @svg('happy', 'm-auto')
                </div>
            </div>
        </div>
    </div>

    <div class="flex-1" style="height: 100%">
        <div class="grid grid-cols-3 grid-rows-3 mt-4 gap-4 h-full w-full">
            <div class="bg-white rounded-xl col-span-2 p-4 row-span-2">
                <div class="flex justify-between mb-4">
                    <h1 class="font-bold text-xl">Monthly mood chart</h1>
                    <h1 class="font-medium">Month of November</h1>
                </div>
                <div class="w-full mt-6">
                    <div class="flex flex-row gap-8">
                        <h1 class="flex">
                            <div class="flex flex-col justify-between ml-5 pb-12 pt-2">
                                @svg('overjoyed')
                                @svg('happy')
                                @svg('neutral')
                                @svg('sad')
                                @svg('depressed')
                            </div>
                        </h1>
                        <h1 class="flex-1">
                            <div class="w-full" style="height: 42.5vh">
                                <canvas id="monthly-mood-chart"></canvas>
                            </div>
                            <script type="module">
                                let data = @js($fetchedData);
                                let labels = Object.keys(data)
                                let dataset = Object.values(data)

                                let options = {
                                    maintainAspectRatio: false,
                                    layout: {
                                        padding: 20,
                                    },
                                    interaction: {
                                        intersect: false,
                                        mode: 'nearest',
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
                                            grid: {
                                                display: false,
                                            },
                                            ticks: {
                                                maxTicksLimit: 10,
                                                display: false,
                                            },
                                            max: 100,
                                            min: 0,
                                        },
                                        x: {
                                            border: {
                                                display: true,
                                            },
                                            grid: {
                                                display: false,
                                            },
                                        },
                                    },
                                    responsive: true
                                };

                                var canvas = document.getElementById("monthly-mood-chart");
                                var ctx = canvas.getContext("2d");
                                var gradient = ctx.createLinearGradient(0, 0, 0, 400);
                                gradient.addColorStop(0, 'rgba(59, 130, 248, 0.5)');
                                gradient.addColorStop(1, 'rgba(59, 130, 248, 0.05)');

                                console.log(data)

                                new Chart(canvas, {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Mood Score',
                                            data: dataset,
                                            fill: true,
                                            backgroundColor: gradient,
                                            borderColor: 'rgb(99 102 241)',
                                            borderWidth: 2,
                                            pointRadius: 0,
                                            pointHoverRadius: 4,
                                            pointBackgroundColor: 'rgb(99 102 241)',
                                            clip: 20,
                                            lineTension: 0.4,
                                        }],
                                    },
                                    options: options,
                                });
                            </script>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="bg-white col-span-1 row-span-2">
                <h1>hello</h1>
            </div>
            <div class="bg-white col-span-1 row-span-1">
                <h1>hello</h1>
            </div>
            <div class="bg-white col-span-1  row-span-1">
                <h1>hello</h1>
            </div>
            <div class="bg-white col-span-1 row-span-1">
                <h1>hello</h1>
            </div>

        </div>
    </div>


    {{-- <div class="flex flex-col col-span-full bg-white shadow-lg rounded-sm border border-slate-200">
        <div class="px-5 py-6">
            <div class="md:flex md:justify-between md:items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <div>
                        <div class="mb-2">Hey <strong
                                class="font-medium text-slate-800">{{ tenant()->company }}</strong> 👋, the average mood
                            levels for
                            the {{ $filter }} is at:</div>
                        <div class="text-3xl font-bold text-emerald-500">{{ $average }}%</div>
                    </div>
                </div>
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
            <div class="grow">
                <canvas id="{{ $filter }}-{{ $selectedId }}-{{ $time }}" class="p-4 w-full"></canvas>
            </div>
        </div>

        <script>
           
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
    @endif --}}


</div>
