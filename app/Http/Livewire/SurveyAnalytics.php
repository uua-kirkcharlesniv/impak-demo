<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SurveyAnalytics extends Component
{
    public $surveys = [];
    public $selectedSurvey;

    public function mount()
    {
        $this->surveys = Survey::all();
    }

    public function getSurveyProperty()
    {
        Log::debug($this->selectedSurvey);
        return $this->surveys[$this->selectedSurvey];
    }

    public function selectedSurveyChanged()
    {
        dd('test');
    }

    public function selectSurvey($index)
    {
        if (count($this->selectedSurvey) > 0) {
            $this->selectedSurvey = $index;
        }
    }

    public function render()
    {
        return view('livewire.survey-analytics');
    }
}
