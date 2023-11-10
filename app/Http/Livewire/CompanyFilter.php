<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CompanyFilter extends Component
{
    public $radioSelected = 'company';
    public $filterApplied = 'company';
    public $idSelected;
    public $nameSelected = '';

    public $data = [];

    public function render()
    {
        return view('livewire.company-filter');
    }

    public function applyFilter()
    {
        $this->filterApplied = $this->radioSelected;

        $this->emit('filterApplied', $this->filterApplied);

        $this->loadData();
    }

    private function loadData()
    {
        $data = [];

        switch ($this->filterApplied) {
            case 'company':
                $this->data = [];
                $this->changeId(null, '');
                return;

            case 'group':
                $groups = Group::all();
                foreach ($groups as $value) {
                    $data[$value->id] = $value->name;
                }
                break;

            case 'department':
                $groups = Department::all();
                foreach ($groups as $value) {
                    $data[$value->id] = $value->name;
                }
                break;

            case 'employee':
                $groups = User::role('employee')->get();
                foreach ($groups as $value) {
                    $data[$value->id] = $value->name;
                }

                break;

            default:
                $this->changeId(null, null);
                return;
        }

        $this->data = $data;
        if (count($data) > 0) {
            $this->changeId(key($data), reset($data));
        }
    }

    public function changeId($id, $name)
    {
        $this->idSelected = $id;
        $this->nameSelected = $name;

        $this->emit('filterIdChanged', $id, $name);
    }
}
