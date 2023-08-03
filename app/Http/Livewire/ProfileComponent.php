<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ProfileComponent extends Component
{
    protected $type = 'employee';
    public $users = [];
    public $selectedId;
    public $host;
    public $initialRequest;

    protected $listeners = ['userSelected' => 'selectUser'];

    public function getUserProperty()
    {
        if (isset($this->host)) {
            $users = $this->host->members;
            Log::debug($users);
            $user = $users->where('id', $this->selectedId)->first();
        } else {
            $user = $this->users->where('id', $this->selectedId)->first();
        }

        if (!isset($user)) {
            abort(500);
        }

        return $user;
    }

    public function selectUser($id)
    {
        $this->selectedId = $id;
    }

    public function deleteDoAction()
    {
        if (isset($this->host)) {
            // in groups/departments
            $this->host->members()->detach($this->user->id);
            $this->loadData($this->host->id);
        } else {
            $user = User::findOrFail($this->user->id);
            $user->delete();
            $this->loadData(null);
        }
    }

    public function reactivateUser()
    {
        User::withTrashed()->where('id', $this->user->id)->restore();
        $this->loadData(null);
        $this->loadData(null);
        $this->loadData(null);
    }

    protected function loadData($id)
    {
        if (in_array($this->initialRequest[0], ['employee'])) {
            $this->type = 'employee';

            if (Auth::user()->hasPermissionTo('manage-employees')) {
                $this->users = User::withTrashed()->get();
            } else {
                $this->users = User::get();
            }
        } else if (in_array($this->initialRequest[1], ['groups'])) {
            $this->type = 'groups';

            $group = Group::findOrFail($id);

            $this->host = $group;

            $this->users = $group->members;

            if (count($this->users) <= 0) {
                return redirect()->route('community.groups.list');
            }
        } else if (in_array($this->initialRequest[1], ['departments'])) {
            $this->type = 'departments';

            $department = Department::findOrFail($id);

            $this->host = $department;

            $this->users = $department->members;

            if (count($this->users) <= 0) {
                return redirect()->route('community.departments.list');
            }
        } else {
            abort(500);
        }

        if (count($this->users) > 0) {
            $this->selectUser($this->users[0]['id']);
        } else {
            return redirect()->to('/dashboard');
        }
    }

    public function mount($id = null)
    {

        $this->initialRequest = Request::segments();
        $this->loadData($id);
    }
    public function render()
    {
        return view('livewire.profile-component');
    }
}
