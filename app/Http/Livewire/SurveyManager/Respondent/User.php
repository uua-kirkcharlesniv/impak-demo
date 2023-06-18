<?php

namespace App\Http\Livewire\SurveyManager\Respondent;

use App\Models\Department;
use App\Models\Group;
use App\Models\User as ModelsUser;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;

    public $allUsers = true;
    public $allGroups = false;
    public $allDepartments = false;

    public function render()
    {
        return view('livewire.survey-manager.respondent.user', [
            'users' =>  ModelsUser::orderBy('first_name')->paginate(2, ['*'], 'usersPaginator'),
            'groups' =>  Group::orderBy('name')->paginate(1, ['*'], 'groupsPaginator'),
            'departments' =>  Department::orderBy('name')->paginate(1, ['*'], 'departmentPaginator'),
        ]);
    }
}
