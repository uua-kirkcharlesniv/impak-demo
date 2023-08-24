<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Group;
use App\Models\Survey;
use App\Models\User;
use Livewire\Component;

class SetupStepper extends Component
{
    public $employeeDone = false;
    public $groupDone = false;
    public $departmentDone = false;
    public $surveyDone = false;
    public $done = false;


    public function mount()
    {
        $this->employeeDone = User::role('employee')->count() > 0;
        $this->groupDone = Group::count() > 0;
        $this->departmentDone = Department::count() > 0;
        $this->surveyDone = Survey::count() > 0;

        $this->done = $this->employeeDone == true &&
            $this->groupDone == true &&
            $this->departmentDone == true &&
            $this->surveyDone == true;
    }

    public function render()
    {
        return view('livewire.setup-stepper');
    }
}
