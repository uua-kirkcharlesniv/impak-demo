<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateEmployeeButton extends Component
{
    use LivewireAlert;

    public $tab = 'create';

    public $name;
    public $email;
    public $phone;
    public $dob;

    protected function rules()
    {
        if($this->tab == 'create') {
            return [
                'name' => 'required|min:3',
                'email' => ['required', 'email', 'unique:users,email'],
                'phone' => 'required|numeric',
                'dob' => 'nullable|date',
            ];
        }
    }

    public function submit()
    {
        if($this->tab == 'create') {
            $this->validate();

            $employee = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'dob' => $this->dob,
                'password' => Hash::make('test1234')
            ]);
            $employee->assignRole('employee');

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
