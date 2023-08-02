<?php

namespace App\Http\Livewire;

use App\Enums\Countries;
use App\Enums\EmployeeContractType;
use App\Enums\WorkModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateEmployeeButton extends Component
{
    use LivewireAlert;

    public $tab = 'create';

    public $first_name;
    public $last_name;
    public $middle_name = '';
    public $gender = 'M';
    public $date_of_hire;
    public $position;
    public $nationality;
    public $civil_status = 'Single';
    public $highest_educational_attainment = 'HS';
    public $email;
    public $phone;
    public $dob;

    public $contract_type = EmployeeContractType::FullTime;
    public $work_model = WorkModel::Remote;
    public $country = Countries::PH;
    public $city = '';
    public $cities = array();

    public $groupIds = [];
    public $departmentId;


    protected $listeners = [
        'groupsSelected' => 'handleGroupsSelected',
        'departmentSelected' => 'handleDepartmentSelected',
    ];

    public function mount()
    {
        $this->cities = User::select('city')->groupBy('city')->get()->pluck('city')->toArray();
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
        if($this->tab == 'create') {
            return [
                'first_name' => 'required|min:3',
                'middle_name' => 'nullable|min:1',
                'last_name' => 'required|min:1',
                'gender' => 'required|string',
                'date_of_hire' => 'required|date',
                'position' => 'nullable|string|max:255',
                'nationality' => 'nullable|string|max:255',
                'civil_status' => 'nullable|string|max:255',
                'highest_educational_attainment' => 'nullable|string|max:255',
                'email' => ['required', 'email', 'unique:users,email'],
                'phone' => 'required|numeric',
                'dob' => 'nullable|date',
                'city' => 'required|string',
                'country' => 'required|string',
                'work_model' => 'required|string',
                'contract_type' => 'required|string',
            ];
        }
    }

    public function submit()
    {
        if($this->tab == 'create') {
            $this->validate();

            $employee = User::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'middle_name' => $this->middle_name,
                'gender' => $this->gender,
                'date_of_hire' => $this->date_of_hire,
                'position' => $this->position,
                'nationality' => $this->nationality,
                'civil_status' => $this->civil_status,
                'highest_educational_attainment' => $this->highest_educational_attainment,
                'email' => $this->email,
                'phone' => $this->phone,
                'dob' => $this->dob,
                'password' => Hash::make('test1234'),
                'city' => $this->city,
                'country' => $this->country,
                'contract_type' => $this->contract_type,
                'work_model' => $this->work_model,
            ]);
            $employee->assignRole('employee');

            if(count($this->groupIds) > 0) {
                $employee->groups()->attach($this->groupIds);
            }

            if($this->departmentId != null) {
                $employee->departments()->attach($this->departmentId);
            }

            $this->reset();

            $this->alert('success', 'Employee added!');

            $is_employee_onboarded = Auth::user()->is_employee_onboarded;
            if($is_employee_onboarded == false || $is_employee_onboarded == 0) {
                Auth::user()->update([
                    'is_employee_onboarded' => true
                ]);
            }
        }
    }
    
    public function render()
    {
        return view('livewire.create-employee-button');
    }
}
