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

        $data = Answer::select('value')->selectRaw('COUNT(*) as count')->where('question_id', $this->question->id)->groupBy('value')->get();
        $dataset = $data->pluck('count', 'value')->toArray();

        $labels = [];
        $compiled = [];



        if ($question->type == 'likert') {
            foreach (generateLikertNames($question->likert_type, $question->likert_order) as $index => $option) {
                array_push($labels, $option);
                if (array_key_exists($option, $dataset)) {
                    array_push($compiled, $dataset[$option]);
                } else {
                    array_push($compiled, 0);
                }
            }
        } else if ($question->type == 'range') {
            foreach (range(1, 10) as $option) {
                array_push($labels, $option);

                if (array_key_exists($option, $dataset)) {
                    array_push($compiled, $dataset[$option]);
                } else {
                    array_push($compiled, 0);
                }
            }
        } else {
            foreach ($dataset as $key => $value) {
                array_push($labels, $key);
                array_push($compiled, $value);
                // array_push($labels, $key);
            }
        }

        $this->labels = $labels;
        $this->dataset = $compiled;
    }

    public function render()
    {
        return view('livewire.survey-question-chart');
    }
}

function rand_color()
{
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}
