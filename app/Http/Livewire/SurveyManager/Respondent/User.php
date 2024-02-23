<?php

namespace App\Http\Livewire\SurveyManager\Respondent;

use App\Models\Department;
use App\Models\Group;
use App\Models\Respondent;
use App\Models\Survey;
use App\Models\User as ModelsUser;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;


class User extends Component
{
    use WithPagination;

    public Survey $survey;

    public $allUsers = false;
    public $allGroups = false;
    public $allDepartments = false;

    public $departmentIds = [];
    public $groupIds = [];
    public $userIds = [];

    public function render()
    {
        return view('livewire.survey-manager.respondent.user', [
            'users' =>  ModelsUser::orderBy('first_name')->paginate(2, ['*'], 'usersPaginator'),
            'groups' =>  Group::orderBy('name')->paginate(2, ['*'], 'groupsPaginator'),
            'departments' =>  Department::orderBy('name')->paginate(2, ['*'], 'departmentPaginator'),
        ]);
    }

    public function mount($survey)
    {
        $this->survey = $survey;

        $departmentIds = Respondent::where('survey_id', $survey->id)
            ->where('type', 'department')->pluck('respondent_id')->toArray();
        $this->departmentIds = $departmentIds;

        $groupIds = Respondent::where('survey_id', $survey->id)
            ->where('type', 'group')->pluck('respondent_id')->toArray();
        $this->groupIds = $groupIds;

        $userIds = Respondent::where('survey_id', $survey->id)
            ->where('type', 'user')->pluck('respondent_id')->toArray();
        $this->userIds = $userIds;
    }

    public function updatedDepartmentIds()
    {
        $this->updateRespondents();
    }

    public function updatedGroupIds()
    {
        $this->updateRespondents();
    }

    public function updatedUserIds()
    {
        $this->updateRespondents();
    }

    public function updateRespondents()
    {
        $data = [];

        if (!empty($this->departmentIds)) {
            foreach ($this->departmentIds as $departmentId) {
                $data[Str::random(12)] = ['respondent_id' => $departmentId, 'type' => 'department'];
            }
        }

        if (!empty($this->groupIds)) {
            foreach ($this->groupIds as $groupId) {
                $data[Str::random(12)] = ['respondent_id' => $groupId, 'type' => 'group'];
            }
        }

        if (!empty($this->userIds)) {
            foreach ($this->userIds as $userId) {
                $data[Str::random(12)] = ['respondent_id' => $userId, 'type' => 'user'];
            }
        }

        $this->survey->respondents()->sync($data);
    }
}
