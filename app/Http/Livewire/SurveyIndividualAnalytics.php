<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SurveyIndividualAnalytics extends Component
{
    public Survey $survey;
    public $rowSpans = [];

    public function mount($survey)
    {
        $this->calculateRowSpan($survey);
        $this->survey = $survey;
    }

    public function calculateRowSpan(Survey $survey)
    {
        $rowSpans = [];

        switch ($survey->framework_id) {
            case 6:
                $rowSpans = $this->calculateKirkPatrickTwo();
                break;
            case 5:
                $rowSpans = $this->calculateKirkPatrickOne();
                break;
            case 2:
                $rowSpans = $this->calculatePostEvent();
                break;

            default:
                $rowSpans = $this->calculateDefault();
                break;
        }

        $this->rowSpans = $rowSpans;
    }

    public function refreshView()
    {
        $this->survey->refresh();
    }

    public function refreshData()
    {
        $this->survey->refresh();
    }

    public function calculatePostEvent()
    {
        return [
            [
                6, 6,
                6, 6,
                4, 4, 4,
            ],
            [
                4, 4, 4,
                4, 4, 4,
                6, 6
            ],
            [
                12
            ]
        ];
    }

    public function calculateKirkPatrickOne()
    {
        return [
            [
                6, 6,
                4, 4, 4
            ],
            [
                6, 6,
            ],
            [
                6, 6
            ],
            [
                6, 6
            ],
            [
                3, 3, 3, 3
            ]
        ];
    }

    public function calculateKirkPatrickTwo()
    {
        return [
            [
                6, 6,
                6, 6,
                6, 6,
                6, 6,
                6, 6,
            ],
            [
                4, 4, 4
            ],
        ];
    }

    public function calculateDefault()
    {
        $list = [];
        for ($i = 0; $i < $this->survey->sections()->count(); $i++) {
            $questionList = [];
            for ($j = 0; $j < $this->survey->sections[$i]->questions()->count(); $j++) {
                array_push($questionList, 12);
            }
            $list[$i] = $questionList;
        }

        return $list;
    }

    public function render()
    {
        return view('livewire.survey-individual-analytics');
    }
}
