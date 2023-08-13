<div>
    <canvas id="{{ $question->key }}"></canvas>

    <script>
        let labels = @js($labels);
        let dataset = @js($dataset);

        new Chart(document.getElementById("{{ $question->key }}"), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                    data: dataset
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                }
            }
        });

        document.addEventListener('livewire:load', function() {
            @this.on('update', (data) => {
                console.log(data)
            })
        })
    </script>
</div>
