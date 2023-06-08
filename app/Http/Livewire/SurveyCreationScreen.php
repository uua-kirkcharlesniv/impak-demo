<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SurveyCreationScreen extends Component
{
    public $screen = 'setup';

    public function updateScreen($screen)
    {
        $this->screen = $screen;
    }
    
    public function render()
    {
        return view('livewire.survey-creation-screen')->with('screen', $this->screen);
    }
}
