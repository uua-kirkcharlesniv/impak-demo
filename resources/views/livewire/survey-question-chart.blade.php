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
                <!-- Item -->
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
            <div class="grow">
                <canvas id="{{ $question->key }}" class="p-4 w-full"></canvas>
            </div>
        </div>

        <script>
            // function percentageToColor(percentage, maxHue = 350, minHue = 220) {
            //     const hue = percentage * (maxHue - minHue) + minHue;
            //     return `hsl(${hue}, 100%, 50%)`;
            // }

            function hashCode(str) { // java String#hashCode
                var hash = 0;
                for (var i = 0; i < str.length; i++) {
                    hash = str.charCodeAt(i) + ((hash << 6) - hash);
                }
                return hash;
            }

            function intToRGB(i) {
                var c = (i & 0x00FFFFFF)
                    .toString(16)
                    .toUpperCase();

                return "00000".substring(0, 6 - c.length) + c;
            }

            let labels = @js($labels);
            let dataset = @js($dataset);
            let label = labels[0] ?? '';
            var backgroundColor = [];

            let sectionIndex = "{{ $sectionIndex }}"
            let questionIndex = "{{ $questionIndex }}"

            switch (labels.length) {
                case 3:
                    // backgroundColor = ["rgb(220 38 38)", "rgb(251 191 36)", "rgb(22 163 74)",
                    // ];
                    backgroundColor = ["rgba(239, 68, 68, 0.8)", "rgba(56, 189, 248, 0.8)", "rgba(16, 185, 129, 0.8)", ];
                    break;
                case 5:
                    // backgroundColor = ["rgb(185 28 28)", "rgb(239 68 68)", "rgb(245 158 11)",
                    //     "rgb(34 197 94)",
                    //     "rgb(21 128 61)"
                    // ];
                    backgroundColor = ["rgb(129 140 248)", "rgb(99 102 241)", "rgb(79 70 229)",
                        "rgb(67 56 202)",
                        "#3644A2"
                    ];
                    // backgroundColor = ["#6366F1"];
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
                    // for (let i = 0; i <= 10; i++) {
                    //     backgroundColor[i] = percentageToColor(i / 10)
                    // }

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
                }
            }



            new Chart(document.getElementById("{{ $question->key }}"), {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        backgroundColor: backgroundColor,
                        data: dataset
                    }]
                },
                options: options,
            });
        </script>
    @endif

    {{-- <header class="px-5 py-4 border-t border-slate-100 flex items-center">
        <h2 class="text-slate-800">{!! $intextGeneration !!}</h2>
    </header> --}}


</div>