<?php

namespace App\Http\Livewire\Survey;

use Livewire\Component;

class Respondents extends Component
{
    public $tab = 'groups';
    public $target = 'individual';

    public function render()
    {
        return view('livewire.survey.respondents');
    }
}
