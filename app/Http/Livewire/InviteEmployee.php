<?php

namespace App\Http\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Component;

class InviteEmployee extends Component
{
    public $invites;

    public function mount()
    {
        $this->invites[] = ['email' => '', 'first_name' => '', 'last_name' => ''];
    }

    public function addInvite()
    {
        $this->invites[] = ['email' => '', 'first_name' => '', 'last_name' => ''];
    }

    public function removeInvite($index)
    {
        unset($this->invites[$index]);
        $this->invites = array_values($this->invites);
    }

    public function render()
    {
        return view('livewire.invite-employee');
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'invites.*.email' => [
                'required',
                'email',
                Rule::unique('invites', 'email'),
                Rule::unique('users', 'email'),
            ],
            'invites.*.first_name' => 'required|string',
            'invites.*.last_name' => 'required|string',
        ], [
            'invites.*.email.unique' => 'This email is already invited / part of your company.',
            'invites.*.email.required' => 'Required',
            'invites.*.email.first_name' => 'Required',
            'invites.*.email.last_name' => 'Required'
        ]);

        dd($validatedData);
    }
}
