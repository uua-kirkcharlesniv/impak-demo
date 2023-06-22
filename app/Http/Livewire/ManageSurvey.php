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

    protected $listeners = ['addBlock' => 'addBlock'];

    public function render()
    {
        return view('livewire.manage-survey');
    }

    public function addBlock($data)
    {
        $sectionId = array_key_last($this->sections);
        $blockId = Str::random(5);
        while (array_key_exists($blockId, $this->sections[$sectionId]["forms"])) {
            $blockId = Str::random(5);
        }
        $this->sections[$sectionId]["forms"][$blockId] = $data;
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

    public function deleteForm($sectionId, $formId)
    {
        unset($this->sections[$sectionId]["forms"][$formId]);
    }

    public function toggleVisibility($sectionId)
    {
        $this->sections[$sectionId]["isVisible"] = !$this->sections[$sectionId]["isVisible"];
    }
}
