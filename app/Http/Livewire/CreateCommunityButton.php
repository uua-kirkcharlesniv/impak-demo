<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CreateCommunityButton extends Component
{
    public $name;
    public $selectedUserId;

    protected $listeners = [
        'userSelected' => 'handleUserSelected',
    ];

    public function handleUserSelected($userId)
    {
        
    }

    public function render()
    {
        $users = User::role('employee')->get();
        return view('livewire.create-community-button', [
            'users' => $users
        ]);
    }
}
