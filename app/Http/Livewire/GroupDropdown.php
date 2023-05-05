<?php

namespace App\Http\Livewire;

use App\Models\Group;
use Livewire\Component;

class GroupDropdown extends Component
{
    public $groups;
    public $selectedGroups;
    public $text;

    public function render()
    {
        return view('livewire.group-dropdown');
    }

    public function mount()
    {
        $this->groups = Group::all();
        $this->text = 'Select Group(s)';
    }

    public function updatedSelectedGroups()
    {
        $list = array();
        $text = [];
        foreach ($this->selectedGroups as $id => $isSelected) {
            if($isSelected) {
                array_push($text, $this->groups->find($id)->name);
                array_push($list,$id);
            }
        }

        if(count($text) == 0) {
            $this->text = 'Select Group(s)';
        } else {
            $this->text = implode(', ', $text);
        }

        $this->emitUp('groupsSelected', $list);
    }
}
