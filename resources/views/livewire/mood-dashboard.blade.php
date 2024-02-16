@once
@section('footer-scripts')
<script type="module">
    let monthlyData = @js($fetchedData);
            let monthlyLabels = Object.keys(monthlyData)
            let monthlyDataset = Object.values(monthlyData)

            let distributionData = @js($moodDistribution);
            let distributionLabels = Object.keys(distributionData)
            let distributionDataset = Object.values(distributionData)

            let weeksData = @js($weeksData);
            let weeksLabel = Object.keys(weeksData)
            let weeksDataset = Object.values(weeksData)

            let monthlyOptions = {
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

            let distributionOptions = {
                cutout: '80%',
                maintainAspectRatio: false,
                layout: {
                    padding: 20,
                },
                interaction: {
                    intersect: false,
                    mode: 'nearest',
                },
                animation: {
                    duration: 200,
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    htmlLegend: {
                        containerID: 'mood-legends',
                    },
                },
                legend: {
                    display: false
                },
                title: {
                    display: false,
                },
                responsive: true
            };

            let weeksOptions = {
                maintainAspectRatio: false,
                layout: {
                    padding: 20,
                },
                interaction: {
                    intersect: false,
                    mode: 'nearest',
                },
                animation: {
                    duration: 200,
                },
                plugins: {
                    legend: {
                        display: false
                    },
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

            var monthlyCanvas = document.getElementById("monthly-mood-chart");
            var monthlyCtx = monthlyCanvas.getContext("2d");
            var monthlyGradient = monthlyCtx.createLinearGradient(0, 0, 0, 400);
            monthlyGradient.addColorStop(0, 'rgba(59, 130, 248, 0.5)');
            monthlyGradient.addColorStop(1, 'rgba(59, 130, 248, 0.05)');

            var weeklyCanvas = document.getElementById("week-chart");
            var weeklyCtx = weeklyCanvas.getContext("2d");
            var weeklyGradient = weeklyCtx.createLinearGradient(0, 0, 0, 600);
            weeklyGradient.addColorStop(0, 'rgb(129 140 248)');
            weeklyGradient.addColorStop(1, 'rgb(49 46 129)');

            var distributionCanvas = document.getElementById("mood-distribution");
            var distributionCtx = distributionCanvas.getContext("2d");
            var distributionGradient = distributionCtx.createLinearGradient(0, 0, 0, 400);
            distributionGradient.addColorStop(0, 'rgba(59, 130, 248, 0.5)');
            distributionGradient.addColorStop(1, 'rgba(59, 130, 248, 0.05)');

            let monthlyChart = new Chart(monthlyCanvas, {
                type: 'line',
                data: {
                    labels: monthlyLabels,
                    datasets: [{
                        label: 'Mood Score',
                        data: monthlyDataset,
                        fill: true,
                        backgroundColor: monthlyGradient,
                        borderColor: 'rgb(99 102 241)',
                        borderWidth: 2,
                        pointRadius: 0,
                        pointHoverRadius: 4,
                        pointBackgroundColor: 'rgb(99 102 241)',
                        clip: 20,
                        lineTension: 0.4,
                    }],
                },
                options: monthlyOptions,
            });

            let distributionChart = new Chart(distributionCanvas, {
                type: 'doughnut',
                data: {
                    labels: distributionLabels,
                    datasets: [{
                        label: 'Mood Score',
                        data: distributionDataset,
                        fill: true,
                        backgroundColor: [
                            'rgb(49 46 129)',
                            'rgb(67 56 202)',
                            'rgb(99 102 241)',
                            'rgb(165 180 252)',
                            'rgb(199 210 254)',
                        ],
                    }],
                },
                options: distributionOptions,
                plugins: [{
                    id: 'htmlLegend',
                    afterUpdate(c, args, options) {
                        const legendContainer = document.getElementById(options.containerID);
                        const ul = legendContainer.querySelector('ul');
                        if (!ul) return;
                        // Remove old legend items
                        while (ul.firstChild) {
                            ul.firstChild.remove();
                        }
                        // Reuse the built-in legendItems generator
                        const items = c.options.plugins.legend.labels.generateLabels(c);
                        items.forEach((item) => {
                            const li = document.createElement('li');
                            li.style.margin = 1;
                            // Button element
                            const button = document.createElement('button');
                            button.classList.add('btn-xs');
                            button.style.backgroundColor = 'white';
                            button.style.borderWidth = '0.25px';
                            button.style.borderColor = 'rgb(226 232 240)';
                            button.style.color = 'rgb(100 116 139)';
                            button.style.boxShadow =
                                '0 4px 6px -1px rgba(0, 0, 0, 0.08), 0 2px 4px -1px rgba(0, 0, 0, 0.02)';
                            button.style.opacity = item.hidden ? '.3' : '';
                            button.onclick = () => {
                                c.toggleDataVisibility(item.index, !item.index);
                                c.update();
                            };
                            // Color box
                            const box = document.createElement('span');
                            box.style.display = 'block';
                            box.style.width = '1.5rem';
                            box.style.height = '1rem';
                            box.style.backgroundColor = item.fillStyle;
                            box.style.borderRadius = '6px';
                            box.style.marginRight = '10px';
                            box.style.pointerEvents = 'none';
                            // Label
                            const label = document.createElement('span');
                            label.style.display = 'flex';
                            label.style.alignItems = 'center';
                            const labelText = document.createTextNode(item.text);
                            label.appendChild(labelText);
                            li.appendChild(button);
                            button.appendChild(box);
                            button.appendChild(label);
                            ul.appendChild(li);
                        });
                    },
                }],
            });

            let weeklyChart = new Chart(weeklyCanvas, {
                type: 'bar',
                data: {
                    labels: weeksLabel,
                    datasets: [{
                        label: 'Mood Score',
                        data: weeksData,
                        fill: true,
                        backgroundColor: weeklyGradient,
                        borderRadius: 50,
                        barThickness: 20,
                    }],
                },
                options: weeksOptions,
            });

            window.addEventListener('dataUpdated', event => {
                try {
                    let monthlyDataset = Object.values(event.detail.monthlyData)
                    let weeklyDataset = Object.values(event.detail.weeklyData)
                    let distributionDataset = Object.values(event.detail.distributionData)

                    monthlyChart.data.datasets[0].data = monthlyDataset
                    monthlyChart.update();

                    distributionChart.data.datasets[0].data = distributionDataset
                    distributionChart.update();

                    weeklyChart.data.datasets[0].data = weeklyDataset
                    weeklyChart.update();
                } catch (e) {
                    console.error(e);
                }
            })
        </script>
@stop
@endonce

<div class="flex flex-col h-full" wire:ignore>
    <div class="flex grid lg:grid-cols-5 md:grid-cols-2 sm:grid-cols-1 gap-6">
        <div class="bg-white rounded-b-2xl p-4 border-t-8 border-indigo-200">
            <div class="flex flex-wrap">
                <div class="w-3/5">
                    <h1 class="text-black text-sm font-bold">Mood score this period</h1>
                </div>
                <div class="w-2/5 place-items-center m-auto">
                    <h1 class="text-center font-black text-2xl text-lime-600">{{ $average }}%</h1>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-b-2xl p-4 border-t-8 border-indigo-400">
            <a href="{{ route('employee.list') }}">
                <div class="flex flex-wrap">
                    <div class="w-3/5">
                        <h1 class="text-black text-sm font-bold">Number of employees</h1>
                    </div>
                    <div class="w-2/5 place-items-center m-auto">
                        <h1 class="text-center font-black text-2xl text-indigo-600">{{ $employeesCount }}</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white rounded-b-2xl p-4 border-t-8 border-indigo-600">
            <a href="{{ route('community.departments.list') }}">
                <div class="flex flex-wrap">
                    <div class="w-3/5">
                        <h1 class="text-black text-sm font-bold">Number of deparments</h1>
                    </div>
                    <div class="w-2/5 place-items-center m-auto">
                        <h1 class="text-center font-black text-2xl text-indigo-600">{{ $departmentCount }}</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white rounded-b-2xl p-4 border-t-8 border-amber-400">
            <a href="{{ route('community.groups.list') }}">
                <div class="flex flex-wrap">
                    <div class="w-3/5">
                        <h1 class="text-black text-sm font-bold">Number of <br>groups</h1>
                    </div>
                    <div class="w-2/5 place-items-center m-auto">
                        <h1 class="text-center font-black text-2xl text-indigo-600">{{ $groupCount }}</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white rounded-b-2xl p-4 border-t-8 border-amber-600">
            <a href="{{ route('survey.ongoing') }}">
                <div class="flex flex-wrap">
                    <div class="w-3/5">
                        <h1 class="text-black text-sm font-bold">Number of active running surveys</h1>
                    </div>
                    <div class="w-2/5 place-items-center m-auto">
                        <h1 class="text-center font-black text-2xl text-indigo-600">{{ $activeSurveysCount }}</h1>
                    </div>
                </div>
            </a>
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
                        </h1>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl col-span-1 p-4 row-span-2">
                <div class="mb-4">
                    <h1 class="font-bold text-xl">Mood Distribution</h1>
                </div>
                <div class="w-full mt-6">
                    <div id="mood-legends" class="px-5 pt-2 pb-6">
                        <ul class="flex flex-wrap justify-center gap-2"></ul>
                    </div>
                    <div class="w-full" style="height: 35vh">
                        <canvas id="mood-distribution"></canvas>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl col-span-3 p-4 row-span-1">
                <div class="mb-4">
                    <h1 class="font-bold text-xl">Mood Score throughout the week</h1>
                </div>
                <div class="w-full mt-6">
                    <div class="w-full" style="height: 17vh">
                        <canvas id="week-chart"></canvas>
                    </div>
                </div>
            </div>
            {{-- <div class="col-span-1 row-span-1">
                <div class="flex flex-col w-full h-full gap-4">
                    <div class="flex-1 bg-white rounded-lg px-6 py-4">
                        <h1 class="text-lg">
                            <div class="flex flex-col">
                                <i class="fa-solid fa-circle-info mb-2"></i>

                                <div class="mx-2 mt-2">
                                    <h1 class="font-medium text-lg">We have noticed that your members have poor mood
                                        score this
                                        period.</h1>
                                    <p class="text-sm mt-4 text-indigo-600">View our personalized recommendations to
                                        take
                                        actions now.</p>
                                </div>


                            </div>

                        </h1>
                    </div>
                    <div class="flex-1 bg-white rounded-lg px-6 py-4">
                        <h1 class="font-bold text-lg">Completion Rate</h1>
                        <div class="w-full h-6 bg-gray-200 rounded-full mt-4">
                            <div class="h-6 bg-indigo-600 rounded-full text-white font-medium text-center" style="width: {{ $completionRate }}%">
            {{ $completionRate }}%
        </div>
    </div>
</div>
</div>
</div> --}}
{{-- <div class="rounded-2xl bg-white text-white col-span-1 row-span-1 p-4 h-full w-full" style="background-color: #6E57E6">
    <div class="flex flex-col h-full">
        <div class="flex mb-6">Your average mood this period</div>
        <div class="flex-1 m-auto h-full">
            @svg('neutral', 'm-auto w-32 h-32')
            <h1 class="mt-4 font-black text-center text-2xl">Neutral</h1>
            <h1 class="mt-4 font-extralight text-center text-sm">Let us know how can we help you more!</h1>
        </div>
    </div>
</div> --}}

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
the {{ $filter }} is at:
</div>
<div class="text-3xl font-bold text-emerald-500">{{ $average }}%</div>
</div>
</div>
</div>
</div>
</div>

<div class="flex flex-col col-span-full row-span-6 bg-white shadow-lg rounded-sm border border-slate-200" wire:key="{{ $filter }}.{{ $selectedId }}.{{ $time }}.{{ now() }}">
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
                        type: 'bar'
                        , data: {
                            labels: labels
                            , datasets: [{
                                label: 'Mood'
                                , backgroundColor: backgroundColor
                                , data: dataset
                            , }]
                        , }
                        , options: options
                    , });
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
                    <div class="mb-2">Your employee has a <strong class="font-medium text-slate-800">{{ $recommendationTitle }}</strong> based on
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
    <div class="flex flex-col col-span-full xl:col-span-4 row-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
        <header class="px-5 py-4 flex items-center">
            <h2 class="font-bold text-slate-800 text-2xl">{{ $title }}</h2>
        </header>

        <p class="p-4 ">{{ $recommendation }}</p>
    </div>
    @endforeach
</div>
@endif --}}
</div>
