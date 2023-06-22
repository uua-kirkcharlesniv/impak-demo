<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

class ManageSurvey extends Component
{
    public $sections = [
        "root_section" => [
            "name" => "Main Page",
            "isVisible" => false,
            "isDeletable" => false,
            "forms" => [],
        ],
    ];

    public function render()
    {
        return view('livewire.manage-survey');
    }

    public function addSection()
    {
        $sectionId = Str::random(5);
        while (array_key_exists($sectionId, $this->sections)) {
            $sectionId = Str::random(5);
        }
        $this->sections[$sectionId] = [
            "name" => "New Section",
            "isVisible" => true,
            "isDeletable" => true,
            "forms" => [],
        ];
    }

    public function deleteSection($sectionId)
    {
        unset($this->sections[$sectionId]);
    }

    public function toggleVisibility($sectionId)
    {
        $this->sections[$sectionId]["isVisible"] = !$this->sections[$sectionId]["isVisible"];
    }
}
