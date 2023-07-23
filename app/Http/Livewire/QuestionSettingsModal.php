<?php

namespace App\Http\Livewire;

use App\Models\Question;
use App\Models\Survey;
use Livewire\Component;

class QuestionSettingsModal extends Component
{
    public Question $question;

    public function render()
    {
        return view('livewire.question-settings-modal');
    }

    public function mount($question)
    {
        $this->question = $question;
    }

    public function modalClosed()
    {
        $this->emit('modalClosed');
    }
}
