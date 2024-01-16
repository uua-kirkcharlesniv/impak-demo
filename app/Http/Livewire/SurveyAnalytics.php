<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SurveyAnalytics extends Component
{
    public $surveys = [];
    public $selectedSurvey;
    public ?Survey $survey;
    public $urlSurveyIndex;

    public function mount()
    {
        $urlSurveyId = request()->query('survey_id', null);
        $allSurveys = Survey::all();
        $this->surveys = $allSurveys;

        if($urlSurveyId) {
            $surveyIndex = $allSurveys->search(function ($survey) use ($urlSurveyId) {
                return $survey->id == $urlSurveyId;
            });
            
            if ($surveyIndex !== false) {
                $this->urlSurveyIndex = $surveyIndex;
            }
        }
    }

    public function updatedSelectedSurvey($value)
    {
        if ($value == "") {
            $this->survey = null;
        } else {
            $this->survey = $this->surveys[$this->selectedSurvey];
        }
    }

    public function render()
    {
        return view('livewire.survey-analytics');
    }
}
