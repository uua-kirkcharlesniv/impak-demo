@php
    $time = time();
@endphp

<div>
    @if ($question->type == 'short-answer' || $question->type == 'long-answer')
        @php
            $maxHeight = '600px';
            if ($sectionIndex == 0 && $questionIndex > 3) {
                $maxHeight = '185px';
            }

            $color = 'bg-indigo-500';
            if ($sectionIndex == 0 && $questionIndex == 4) {
                $color = 'bg-red-500';
            } elseif ($sectionIndex == 0 && $questionIndex == 6) {
                $color = 'bg-sky-500';
            }
        @endphp

        <div class="p-3 mb-6" style="overflow:auto">
            <header class="text-xs uppercase text-slate-400 bg-slate-50 rounded-sm font-semibold p-2">Answers</header>
            <ul class="my-1" style="max-height: {{ $maxHeight }};">
                @foreach ($answers as $answer)
                    <li class="flex px-2">
                        <div class="w-9 h-9 rounded-full shrink-0 {{ $color }} my-2 mr-3">
                            <svg class="w-9 h-9 fill-current text-indigo-50" viewBox="0 0 36 36">
                                <path
                                    d="M18 10c-4.4 0-8 3.1-8 7s3.6 7 8 7h.6l5.4 2v-4.4c1.2-1.2 2-2.8 2-4.6 0-3.9-3.6-7-8-7zm4 10.8v2.3L18.9 22H18c-3.3 0-6-2.2-6-5s2.7-5 6-5 6 2.2 6 5c0 2.2-2 3.8-2 3.8z" />
                            </svg>
                        </div>
                        <div class="grow flex items-center border-b border-slate-100 text-sm py-2">
                            <div class="grow flex justify-between" x-data="{ showFullText: false }">
                                <div class="self-center"><span class="text-slate-800 hover:text-slate-900"
                                        x-text="showFullText ? '{{ $answer['value'] }}' : '{{ \Illuminate\Support\Str::limit($answer['value'], 25, $end = '...') }}'"></span>
                                </div>
                                <div class="shrink-0 self-end ml-2">
                                    <a class="font-medium text-indigo-500 hover:text-indigo-600"
                                        x-on:click="showFullText = true" href="#0">View<span
                                            class="hidden sm:inline"> -&gt;</span></a>
                                </div>

                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <div>
            @if ($question->type == 'likert')
                <ul class="flex flex-wrap ml-6">
                    <li style="margin-right: 16px;"><button style="display: inline-flex; align-items: center;"><span
                                style="display: block; width: 12px; height: 12px; border-radius: 9999px; margin-right: 8px; border-width: 3px; border-color: rgb(96, 165, 250); pointer-events: none;"></span><span
                                style="display: flex; align-items: center;"><span class="text-slate-800 "
                                    style="font-size: 1.35rem; line-height: 1.33; font-weight: 700; margin-right: 8px; pointer-events: none;">{{ $max }}</span><span
                                    class="text-slate-400" style="font-size: 0.875rem; line-height: 1.5715;">Most
                                    answered</span></span></button></li>
                    <li style="margin-right: 16px;"><button style="display: inline-flex; align-items: center;"><span
                                style="display: block; width: 12px; height: 12px; border-radius: 9999px; margin-right: 8px; border-width: 3px; border-color: rgb(99, 102, 241); pointer-events: none;"></span><span
                                style="display: flex; align-items: center;"><span class="text-slate-800"
                                    style="font-size: 1.35rem; line-height: 1.33; font-weight: 700; margin-right: 8px; pointer-events: none;">{{ $min }}</span><span
                                    class="text-slate-400" style="font-size: 0.875rem; line-height: 1.5715;">Least
                                    answered</span></span></button></li>
                </ul>
            @endif

            @if ($frameworkId == 5 && $question->type == 'range')
                <div id="{{ $question->key }}-{{ $time }}-gauge" class="w-full"></div>
            @else
                <div class="grow">
                    <canvas id="{{ $question->key }}-{{ $time }}" class="p-4 w-full"></canvas>
                </div>
            @endif
        </div>

        @if ($frameworkId == 5 && $question->type == 'range')
            <script>
                let element = document.querySelector('#{{ $question->key }}-{{ $time }}-gauge')
                let elementWidth = element.clientWidth;
                let labels = @js($labels);

                let dataset = @js($dataset);
                let responses = labels.reduce((acc, current, index) => {
                    acc[current] = dataset[index];
                    return acc;
                }, {});

                var totalSum = 0;
                var totalCount = 0;
                // Iterate through each key-value pair in the responses
                for (const value in responses) {
                    if (responses.hasOwnProperty(value)) {
                        // Add the product of value and its corresponding number of answers to the total sum
                        totalSum += value * responses[value];
                        // Add the number of answers to the total count
                        totalCount += responses[value];
                    }
                }

                // Calculate the average by dividing the total sum by the total count
                const average = (totalSum / totalCount) * 10;

                var value = Math.round(average);
                // Properties of the gauge
                let gaugeOptions = {
                    hasNeedle: true,
                    needleColor: 'gray',
                    needleUpdateSpeed: 1000,
                    arcColors: ['#4f46e5', '#e2e8f0'],
                    arcDelimiters: [value],
                    rangeLabel: ['0', '100'],
                    centralLabel: '' + value,
                }

                // Drawing and updating the chart
                GaugeChart.gaugeChart(element, elementWidth, gaugeOptions).updateNeedle(value)
            </script>
        @else
            <script>
                let labels = @js($labels);
                let dataset = @js($dataset);
                let label = labels[0] ?? '';
                var backgroundColor = [];

                let sectionIndex = "{{ $sectionIndex }}"
                let questionIndex = "{{ $questionIndex }}"

                switch (labels.length) {
                    case 3:
                        backgroundColor = ["rgba(239, 68, 68, 0.8)", "rgba(56, 189, 248, 0.8)", "rgba(16, 185, 129, 0.8)", ];
                        break;
                    case 5:
                        backgroundColor = ["rgb(129 140 248)", "rgb(99 102 241)", "rgb(79 70 229)",
                            "rgb(67 56 202)",
                            "#3644A2"
                        ];
                        break;
                    case 10:
                        backgroundColor = [
                            "rgba(153, 27, 27, 1)",
                            "rgba(220, 38, 38, 1)",
                            "rgba(248, 113, 113, 1)",
                            "rgba(254, 202, 202, 1)",
                            "rgba(34, 197, 94, 1)",
                            "rgba(56, 189, 248, 1)",
                            "rgba(2, 132, 199, 1)",
                            "rgba(7, 89, 133, 1)",
                            "rgba(79, 70, 229, 1)",
                            "rgba(55, 48, 163, 1)",
                        ];

                        break;
                    default:
                        for (let i = 0; i < labels.length; i++) {
                            backgroundColor[i] = "rgb(129 140 248)";
                        }
                        break;
                }

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
                    responsive: true
                };

                var frameworkId = "{{ $frameworkId }}";
                var questionType = "{{ $question->type }}";
                if (questionType == 'long-answer' || questionType == 'short-answer') {
                    options['indexAxis'] = 'y';
                }

                var type = labels.length == 3 ? 'polarArea' : 'bar';

                if (sectionIndex == 1 && questionIndex > 5) {
                    type = 'polarArea';
                    backgroundColor = [
                        "rgba(185, 28, 28, 0.8)",
                        "rgba(239, 68, 68, 0.8)",
                        "rgba(34, 197, 94, 0.8)",
                        "rgba(56, 189, 248, 0.8)",
                        "rgba(67, 56, 202, 0.8)"
                    ];
                }

                if (type != 'polarArea' && type != 'pie') {
                    options = {
                        ...options,
                        scales: {
                            y: {
                                border: {
                                    display: false,
                                },
                                ticks: {
                                    maxTicksLimit: 5,

                                },
                            },
                        },
                        x: {
                            ticks: {
                                autoSkip: false,
                                maxRotation: 0,
                                minRotation: 0,
                                font: {
                                    size: 9.5,
                                }
                            }
                        }
                    }
                }

                new Chart(document.getElementById("{{ $question->key }}-{{ $time }}"), {
                    type: type,
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "{{ $question->content }}",
                            backgroundColor: backgroundColor,
                            data: dataset
                        }]
                    },
                    options: options,
                });
            </script>
        @endif
    @endif

    @if ($question->quant()->exists())
        <footer class="border-l-8 border-indigo-600 bg-indigo-400 p-4 text-white">
            @if ($question->quant->desc != null)
                <span>{{ $question->quant->desc }}</span>
                <br><br><br>
            @endif
            <span class="font-light">Mean: {{ $question->quant->mean }} | Median: {{ $question->quant->median }} |
                Mode: {{ $question->quant->mode }} | Std. Deviation: {{ $question->quant->zscore }}</span>
        </footer>
    @endif
</div>
