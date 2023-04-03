<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompanyFilter extends Component
{
    public $radioSelected = 'company';
    public $filterApplied = 'company';

    public function render()
    {
        return view('livewire.company-filter');
    }

    public function applyFilter()
    {
        $this->filterApplied = $this->radioSelected;
    }
}
