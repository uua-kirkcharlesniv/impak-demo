<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateEmployeeButton extends Component
{
    public $tab = 'create';
    
    public function render()
    {
        return view('livewire.create-employee-button');
    }
}
