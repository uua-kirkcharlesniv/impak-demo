<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class EmployeeCheckboxDropdown extends Component
{
    public $users;
    public $alreadyChosenIds = [];
    public $selectedText;

    public function render()
    {
        return view('livewire.employee-checkbox-dropdown');
    }

    public function mount($users)
    {
        $this->users = $users;
        $this->alreadyChosenIds = [];
        $this->selectedText = 'Select a user';
    }

    public function updatedAlreadyChosenIds()
    {
        $list = array();
        $text = [];
        foreach ($this->alreadyChosenIds as $id => $isSelected) {
            if($isSelected) {
                array_push($text, $this->users->find($id)->name);
                array_push($list,$id);
            }
        }

        if(count($text) == 0) {
            $this->selectedText = 'Select a user';
        } else {
            $this->selectedText = implode(', ', $text);
        }

        $this->emitUp('usersSelected', $list);
    }
}
