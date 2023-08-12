<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use MattDaneshvar\Survey\Models\Answer;
use MattDaneshvar\Survey\Models\Entry;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class SurveyQuestionChart extends Component
{
    public array $dataset = [];
    public array $labels = [];
    public $question;

    public function mount($question)
    {
        $this->question = $question;
    }

    public function render()
    {
        $data = Answer::select('value')->selectRaw('COUNT(*) as count')->where('question_id', $this->question->id)->groupBy('value')->get();
        $dataset = $data->pluck('count', 'value')->toArray();
        $chart = LivewireCharts::pieChartModel();
        foreach ($dataset as $key => $value) {
            $chart->addSlice($key, $value, rand_color());
        }


        return view('livewire.survey-question-chart')->with(
            [
                'chart' => $chart,
            ]
        );
    }
}

function rand_color()
{
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}
