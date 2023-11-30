<?php

namespace App\Http\Livewire;

use App\Enums\Countries;
use App\Enums\EmployeeContractType;
use App\Enums\WorkModel;
use App\Mail\EmployeeRegister;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateEmployeeButton extends Component
{
    use LivewireAlert;

    public $tab = 'create';

    public $first_name;
    public $last_name;
    public $email;
    public $is_admin = false;

    public $groupIds = [];
    public $departmentId;

    protected $listeners = [
        'groupsSelected' => 'handleGroupsSelected',
        'departmentSelected' => 'handleDepartmentSelected',
    ];

    public $minimalist = false;

    public function mount($minimalist = false)
    {
        $this->cities = User::select('city')->groupBy('city')->get()->pluck('city')->toArray();
        if (isset($minimalist) && $minimalist == true) {
            $this->minimalist = true;
        }
    }

    public function handleGroupsSelected($usersId)
    {
        $this->groupIds = $usersId;
    }

    public function handleDepartmentSelected($departmentId)
    {
        $this->departmentId = $departmentId;
    }

    protected function rules()
    {
        if ($this->tab == 'create') {
            return [
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:1',
                'email' => ['required', 'email', 'unique:users,email'],
            ];
        }
    }

    public function submit()
    {
        if ($this->tab == 'create') {
            $this->validate();

            $employee = User::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'password' => Hash::make('test1234'),
            ]);

            if ($this->is_admin) {
                $employee->assignRole('manager');
            } else {
                $employee->assignRole('employee');
            }

            if (count($this->groupIds) > 0) {
                $employee->groups()->attach($this->groupIds);
            }

            if ($this->departmentId != null) {
                $employee->departments()->attach($this->departmentId);
            }

            $this->reset();

            $this->alert('success', 'Employee added!');

            Mail::to($employee->email)->send(new EmployeeRegister($employee));
        }
    }

    public function render()
    {
        return view('livewire.create-employee-button');
    }
}
