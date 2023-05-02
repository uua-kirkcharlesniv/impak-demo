<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EmployeeRadioDropdown extends Component
{
    public $users;
    public $selectedUserId;
    public $selectedText;


    public function render()
    {
        return view('livewire.employee-radio-dropdown');
    }

    public function mount($users)
    {
        $this->users = $users;
        $this->selectedUserId = $users->first()->id;
        $this->selectedText = $users->first()->name;
    }

    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
        $this->selectedText = $this->users->find($userId)->name;
        $this->emitUp('userSelected', $userId);
    }
}
