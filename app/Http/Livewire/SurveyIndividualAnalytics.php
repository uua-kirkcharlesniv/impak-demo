<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SurveyIndividualAnalytics extends Component
{
    public Survey $survey;

    public function mount($survey)
    {
        $this->survey = $survey;
    }

    public function refreshView()
    {
        Log::debug('refreshed');
        $this->survey->refresh();
    }

    public function render()
    {
        return view('livewire.survey-individual-analytics');
    }
}
