<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\Department;
use App\Models\Group;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateCommunityButton extends Component
{
    use LivewireAlert;

    public $isDepartment = false;
    public $name;
    public $selectedUserId;
    public $membersIds = [];

    protected $listeners = [
        'userSelected' => 'handleUserSelected',
        'usersSelected' => 'handleUsersSelected',
    ];

    public function handleUserSelected($userId)
    {
        $this->selectedUserId = $userId;
        $this->membersIds = [];
        $this->render();
    }

    public function handleUsersSelected($usersId)
    {
        $this->membersIds = $usersId;
        Log::debug($usersId);
    }

    public function render()
    {
        $users = User::role('employee')->get();
        if ($this->selectedUserId != null) {
            $filteredUsers = $users->filter(function ($user) {
                return $user->id != $this->selectedUserId;
            });
        } else {
            $filteredUsers = [];
        }

        return view('livewire.create-community-button', [
            'users' => $users,
            'members' => $filteredUsers,
        ]);
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'selectedUserId' => ['required', 'exists:users,id'],
            'membersIds' => 'nullable|array',
            'membersIds.*' => 'exists:users,id'
        ];
    }

    public function submit()
    {
        $this->validate();

        $leaders = [$this->selectedUserId];
        $members = $this->membersIds;
        $masterlist = [];


        if ($this->isDepartment) {
            $model = Department::create([
                'name' => $this->name,
            ]);
        } else {
            $model = Group::create([
                'name' => $this->name,
            ]);
        }

        foreach ($leaders as $leader) {
            $masterlist[$leader] = ['is_leader' => true];
        }

        foreach ($members as $member) {
            $masterlist[$member] = ['is_leader' => false];
        }

        $model->members()->attach($masterlist);

        // $this->alert('success', $this->isDepartment ? 'Department added!' : 'Group added!');

        $this->resetExcept('isDepartment');

        if ($this->isDepartment) {
            return redirect()->route('community.departments.list');
        } else {
            return redirect()->route('community.groups.list');
        }
    }
}
