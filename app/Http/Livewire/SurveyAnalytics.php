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

    public function mount()
    {
        $this->surveys = Survey::all();
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
