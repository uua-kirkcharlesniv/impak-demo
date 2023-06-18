<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateSurveyButton extends Component
{
    public $tab = 'select';

    public function render()
    {
        return view('livewire.create-survey-button');
    }
}
