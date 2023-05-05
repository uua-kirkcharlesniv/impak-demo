<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;

class DepartmentDropdown extends Component
{
    public $departments;
    public $text;
    public $selectedDepartmentId;

    public function render()
    {
        return view('livewire.department-dropdown');
    }

    public function mount()
    {
        $this->departments = Department::all();
        $this->text = 'Select department';
    }

    public function selectDepartment($departmentId)
    {
        $this->selectedDepartmentId = $departmentId;
        $this->text = $this->departments->find($departmentId)->name;
        $this->emitUp('departmentSelected', $departmentId);
    }
}
