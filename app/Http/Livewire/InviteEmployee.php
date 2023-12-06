<?php

namespace App\Http\Livewire;

use App\Mail\InviteUser;
use App\Models\Invite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class InviteEmployee extends Component
{
    use LivewireAlert;

    public $invites;
    public $showButton;

    public function mount($showButton = true)
    {
        $this->showButton = $showButton;
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
        $inviter = Auth::user()->email;

        $this->validate([
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

        foreach ($this->invites as $index => $data) {
            $invite = Invite::create([
                'email' => $data['email'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'token' => Str::random(16),
                'inviter_email' => $inviter,
            ]);

            Mail::to($data['email'])->send(new InviteUser($invite));
        }

        $this->alert('success', 'Employees invited!');

        $this->invites = [];
        $this->addInvite();
    }
}
