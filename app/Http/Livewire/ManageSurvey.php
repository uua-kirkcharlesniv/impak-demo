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

    // Sorting functionalities
    public function updateSectionOrder($orderIds)
    {
        $sections = $this->sections;

        // Create a new array to store the sorted sections
        $sortedSections = [];

        // Iterate through the order IDs array
        foreach ($orderIds as $order) {
            $sectionName = $order['value'];

            // Check if the section exists in the original array
            if (isset($sections[$sectionName])) {
                // Check if the section is the "root_section"
                if ($sectionName === 'root_section') {
                    // Add the "root_section" at the beginning of the sorted array
                    $sortedSections = array_merge([$sectionName => $sections[$sectionName]], $sortedSections);
                } else {
                    // Add the section to the sorted array
                    $sortedSections[$sectionName] = $sections[$sectionName];
                }
            }
        }

        // Assign the sorted sections back to the original array
        $this->sections = $sortedSections;

        // Optionally, you can perform any other necessary actions here
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
