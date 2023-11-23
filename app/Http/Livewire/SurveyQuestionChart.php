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
    public array $answers = [];
    public $question;
    public $intextGeneration = '';
    public $min;
    public $max;

    public $sectionIndex;
    public $questionIndex;
    public $frameworkId;

    public function mount($sectionIndex, $questionIndex, $question, $frameworkId)
    {
        $this->sectionIndex = $sectionIndex;
        $this->questionIndex = $questionIndex;
        $this->frameworkId = $frameworkId;

        $this->question = $question;

        $data = Answer::select('value')->selectRaw('COUNT(*) as count')->where('question_id', $this->question->id)->groupBy('value')->get();
        $dataset = $data->pluck('count', 'value')->toArray();

        if ($question->type == 'short-answer' || $question->type == 'long-answer') {
            $this->answers = Answer::where('question_id', $this->question->id)->get()->toArray();
        }

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

        if (count($dataset) > 0) {
            $maxs = array_keys($dataset, max($dataset));
            $text = "<b>" . join(", ", $maxs) . "</b> has the highest value of " . max($dataset) . ". ";

            if (count($maxs) > 0) {
                $this->max = $maxs[0];
            }

            $mins = array_keys($dataset, min($dataset));
            $text .= "<i>" . join(", ", $mins) . "</i> has the highest lowest value of " . min($dataset) . ".";

            if (count($mins) > 0) {
                $this->min = $mins[0];
            }

            // $avg = Answer::where('question_id', $this->question->id)->avg('value');

            // $sum = 0;
            // $count = count($dataset);

            // foreach ($dataset as $key => $value) {
            //     $sum += $value;
            // }

            // $mean = $sum / $count;

            // $middle = floor($count / 2);

            // if ($count % 2 == 0) {
            //     $median = ($dataset[$middle - 1] + $dataset[$middle]) / 2;
            // } else {
            //     $median = $labels[$middle];
            // }

            // $text .= " <br> Median is <b>$median</b>. Mode is <b>$middle</b>";

            $this->intextGeneration = $text;
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
