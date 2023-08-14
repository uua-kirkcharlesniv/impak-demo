<div>
    <div class="grow">
        <canvas id="{{ $question->key }}" class="p-4 w-full"></canvas>
    </div>

    <header class="px-5 py-4 border-t border-slate-100 flex items-center">
        <h2 class="text-slate-800">{!! $intextGeneration !!}</h2>
    </header>

    <script>
        function percentageToColor(percentage, maxHue = 120, minHue = 10) {
            const hue = percentage * (maxHue - minHue) + minHue;
            return `hsl(${hue}, 100%, 50%)`;
        }

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

        switch (labels.length) {
            case 3:
                backgroundColor = ["rgb(185 28 28)", "rgb(245 158 11)",

                    "rgb(21 128 61)"
                ];
                break;
            case 5:
                backgroundColor = ["rgb(185 28 28)", "rgb(239 68 68)", "rgb(245 158 11)",
                    "rgb(34 197 94)",
                    "rgb(21 128 61)"
                ];
                break;
            case 10:
                for (let i = 0; i <= 10; i++) {
                    backgroundColor[i] = percentageToColor(i / 10)
                }

                break;
            default:
                for (let i = 0; i < labels.length; i++) {
                    backgroundColor[i] = "#" + intToRGB(hashCode(labels[i]))
                }
                break;
        }

        let options = {
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
            }
        };

        var questionType = "{{ $question->type }}";
        if (questionType == 'long-answer' || questionType == 'short-answer') {
            options['indexAxis'] = 'y';
        }

        new Chart(document.getElementById("{{ $question->key }}"), {
            type: 'bar',
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
</div>
