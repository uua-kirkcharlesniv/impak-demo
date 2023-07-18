<?php

namespace App\Http\Livewire;

use App\Models\Question;
use App\Models\Section;
use App\Models\Survey;
use Carbon\Carbon;
use Livewire\Component;

class ManageSurvey extends Component
{
    public Survey $survey;
    public $selectedSectionId;

    // Rationale
    public $rationale = '';
    public $rationale_description = '';
    public $survey_type = 'post_event';

    // Manual Rationale Type
    public $manual_survey_type = '';
    public $manual_sections = '';
    public $sub_specialization = '';


    protected $rules = [
        'survey.name' => 'required|max:250|min:3|string',
        'survey.settings.limit-per-participant' => 'nullable|numeric|min:0|max:999',
        'survey.sections.*.name' => 'required|min:1|max:250|string',
        'survey.sections.*.questions.*.content' => 'required|min:1|max:250|string'
    ];

    public function render()
    {
        return view('livewire.manage-survey');
    }

    public function mount($survey)
    {
        $this->survey = $survey;
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
        // $this->sections = $sortedSections;

        // Optionally, you can perform any other necessary actions here
    }



    public function addBlock($data)
    {
        $this->survey = $this->survey->refresh();

        // $sectionId = array_key_last($this->sections);
        // $blockId = Str::random(5);
        // while (array_key_exists($blockId, $this->sections[$sectionId]["forms"])) {
        //     $blockId = Str::random(5);
        // }
        // $this->sections[$sectionId]["forms"][$blockId] = $data;
    }

    public function addSection()
    {
        $this->survey->sections()->create(['name' => 'New Section']);
        $this->survey = $this->survey->refresh();
    }

    public function deleteSection($sectionId)
    {
        Section::where('id', $sectionId)->delete();
        $this->survey = $this->survey->refresh();
    }

    public function deleteQuestion($questionId)
    {
        Question::where('id', $questionId)->delete();
        $this->survey = $this->survey->refresh();
    }

    public function onSurveyNameChanged($data)
    {
        $this->validate();

        $this->survey->update(['name' => $data]);

        $this->survey = $this->survey->refresh();
    }

    public function onMaxSubmissionsChanged($data)
    {
        $this->validate();

        $this->survey->update([
            'settings' => [
                'limit-per-participant' => $data,
            ],
        ]);

        $this->survey = $this->survey->refresh();
    }

    public function onSectionNameChanged($id, $data)
    {
        $this->validate();

        Section::where('id', $id)->update([
            'name' => $data
        ]);
    }

    public function onQuestionNameChange($id, $data)
    {
        $this->validate();

        Question::where('id', $id)->update([
            'content' => $data
        ]);
    }

    public function toggleSectionSelection($id)
    {
        $this->selectedSectionId = $id;
    }

    public function pick($type)
    {
        if ($this->selectedSectionId == null) {
            return;
        }

        $section = Section::findOrFail($this->selectedSectionId);

        $title = '';
        $isRequired = true;
        $nameHidden = false;
        $validation = [];
        $additionals = [];

        switch ($type) {
            case 'short-answer':
                $section->questions()->create([
                    'content' => 'Short Answer Field',
                    'type' => 'text',
                    'rules' => ['required', 'string', 'max:250'],
                ]);

                break;
            case 'long-answer':
                $section->questions()->create([
                    'content' => 'Long Answer Field',
                    'type' => 'text',
                    'rules' => ['required', 'string', 'max:1000'],
                ]);
                break;
            case 'date':
                $section->questions()->create([
                    'content' => 'Date Field',
                    'type' => 'text',
                    'rules' => ['required', 'string', 'date_format:m/d/Y'],
                ]);

                break;
            case 'time':
                $section->questions()->create([
                    'content' => 'Time Field',
                    'type' => 'text',
                    'rules' => ['required', 'string', 'date_format:H:i'],
                ]);

                break;
            case 'checkbox':
                $section->questions()->create([
                    'content' => 'Checkbox Field',
                    'type' => 'multiselect',
                    'options' => ['Question 1', 'Question 2', 'Question 3'],
                    'rules' => ['nullable', 'array'],
                ]);

                break;
            case 'radio':
                $section->questions()->create([
                    'content' => 'Radio Field',
                    'type' => 'radio',
                    'options' => ['Question 1', 'Question 2', 'Question 3'],
                    'rules' => ['required'],
                ]);

                break;
            case 'likert':
                $section->questions()->create([
                    'content' => 'Likert Scale Field',
                    'type' => 'likert',
                    'options' => ['type:full', 'order:asc'],
                    'rules' => ['required'],
                ]);

                break;
            case 'radio-grid':
                $title = 'Radio Grid';

                $additionals['helper'] = '';
                break;
            case 'photo':
                $title = 'Photo Upload';

                $additionals['helper'] = '';
                break;
            case 'document':
                $title = 'Document Upload';

                $additionals['helper'] = '';
                break;
        }

        $this->survey = $this->survey->refresh();
        $this->selectedSectionId = null;
    }
}
