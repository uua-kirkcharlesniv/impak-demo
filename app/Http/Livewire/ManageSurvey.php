<?php

namespace App\Http\Livewire;

use App\Jobs\ProcessGenerateSurvey;
use App\Mail\NewSurveyMail;
use App\Mail\SurveyCompletedMail;
use App\Models\Question;
use App\Models\Section;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\User;

class ManageSurvey extends Component
{
    use LivewireAlert;

    public Survey $survey;
    public ?Question $selectedQuestion;
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
        'survey.sections.*.questions.*.content' => 'required|min:1|max:250|string',
        'survey.rationale' => 'nullable|string|max:250',
        'survey.rationale_description' => 'nullable|string|max:1000',
        'survey.survey_type' => 'required|string|max:250',
        'survey.manual_survey_type' => 'nullable|string|max:250',
        'survey.manual_sections' => 'nullable|string|max:250',
        'survey.target_focus' => 'nullable|string|max:250',
    ];

    public function getListeners()
    {
        return [
            "echo:" . tenant('id') . ".surveys.{$this->survey->id},SurveyGenerated" => 'refreshSurveyData',
            'modalClosed' => 'deattachSelectedQuestion',
            'updateSurveyStatusToPublished',
            'updateSurveyStatusToClosed',
        ];
    }

    public function refreshSurveyData()
    {
        $this->alert('success', 'Survey has been successfully generated!');

        $this->survey = $this->survey->refresh();
    }

    public function deattachSelectedQuestion()
    {
        $this->selectedQuestion = null;
        $this->survey = $this->survey->refresh();
    }

    public function render()
    {
        return view('livewire.manage-survey');
    }

    public function mount($survey)
    {
        $this->survey = $survey;
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

    public function onRationaleChanged($data)
    {
        $this->validate();

        $this->survey->update(['rationale' => $data]);

        $this->survey = $this->survey->refresh();
    }

    public function onRationaleDescriptionChanged($data)
    {
        $this->validate();

        $this->survey->update(['rationale_description' => $data]);

        $this->survey = $this->survey->refresh();
    }

    public function onSurveyTypeChanged($data)
    {
        $this->validate();

        $this->survey->survey_type = $data;
        $this->survey->save();

        $this->survey = $this->survey->refresh();
    }

    public function onManualSurveyTypeChanged($data)
    {
        $this->validate();

        $this->survey->update(['manual_survey_type' => $data]);

        $this->survey = $this->survey->refresh();
    }

    public function onManualSectionsChanged($data)
    {
        $this->validate();

        $this->survey->update(['manual_sections' => $data]);

        $this->survey = $this->survey->refresh();
    }

    public function onTargetFocusChanged($data)
    {
        $this->validate();

        $this->survey->update(['target_focus' => $data]);

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
                    'type' => 'date',
                    'rules' => ['required', 'string', 'date_format:Y-m-d'],
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
                    'options' => ['Question 1', 'Question 2', 'Question 3', 'Question 4'],
                    'rules' => ['nullable', 'array', 'max:3'],
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
                    'options' => ['full', 'asc'],
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
            case 'range':
                $section->questions()->create([
                    'content' => 'Range Slider',
                    'type' => 'range',
                    'options' => [
                        'Not likely',
                        'Most likely'
                    ],
                    'rules' => ['min:1', 'max:10'],
                ]);
                break;
        }

        $this->survey = $this->survey->refresh();
        $this->selectedSectionId = null;
    }

    public function updateSectionOrder($id, $old, $new)
    {
        $section = Section::findOrFail($id);

        if ($new > $old) {
            Section::where('survey_id', $section->survey_id)
                ->where('sort_order', '>', $old)
                ->where('sort_order', '<=', $new)
                ->decrement('sort_order');
        } else if ($new < $old) {
            Section::where('survey_id', $section->survey_id)
                ->where('sort_order', '>=', $new)
                ->where('sort_order', '<', $old)
                ->increment('sort_order');
        }

        $section->sort_order = $new;
        $section->save();

        $this->survey = $this->survey->refresh();
    }

    public function updateQuestionSectionId($questionId, $sectionId)
    {
        $question = Question::findOrFail($questionId);

        $question->section_id = $sectionId;
        $question->save();

        $this->survey = $this->survey->refresh();
    }

    public function updateQuestionOrder($id, $new)
    {
        $question = Question::findOrFail($id);
        $old = $question->sort_order;

        if ($new > $old) {
            Question::where('section_id', $question->section_id)
                ->where('survey_id', $question->survey_id)
                ->where('sort_order', '>', $old)
                ->where('sort_order', '<=', $new)
                ->decrement('sort_order');
        } else if ($new < $old) {
            Question::where('section_id', $question->section_id)
                ->where('survey_id', $question->survey_id)
                ->where('sort_order', '>=', $new)
                ->where('sort_order', '<', $old)
                ->increment('sort_order');
        }

        $question->sort_order = $new;
        $question->save();

        $this->survey = $this->survey->refresh();
    }

    public function editQuestion($questionId)
    {
        $question = Question::findOrFail($questionId);
        $this->selectedQuestion = $question;
    }

    public function updateStatus($data)
    {
        $text = "";
        $content = "";
        $functionName = "";
        if ($data == "published") {
            $text = "Are you sure you want to publish the survey?";
            $content = "Doing so, it will allow respondents to view and answer your survey.";
            $functionName = "updateSurveyStatusToPublished";
        } else if ($data == "closed") {
            $text = "Are you sure you want to close the survey?";
            $content = "Doing so, it will prevent respondents from answering, and will start the AI analysis.";
            $functionName = "updateSurveyStatusToClosed";
        }

        $data = $this->alert('question', $text, [
            'text' => $content,
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes',
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancel',
            'onConfirmed' => $functionName,
            'allowOutsideClick' => false,
            'timer' => null,
        ]);
    }

    public function updateSurveyStatusToPublished()
    {
        $this->updateSurveyStatus('published');
    }

    public function updateSurveyStatusToClosed()
    {
        $this->updateSurveyStatus('closed');
    }

    public function updateSurveyStatus($data)
    {
        $this->survey->update(['publish_status' => $data]);

        $this->survey = $this->survey->refresh();

        if($data == "published") {
            /// Get all target user ids
            $targetUserIds = $this->survey->target_user_ids;

            /// Get all emails of the target user ids
            $respondents = User::whereIn('id', $targetUserIds)->pluck('email')->toArray();

            foreach ($respondents as $respondent) {
                Mail::to($respondent)
                    ->queue(new NewSurveyMail(route('survey.view', $this->survey->id), $this->survey->name));   
            }
        }

        if ($data == "closed") {
            $this->alert(
                'success',
                "Congratulations!",
                [
                    "text" => "You just used one of our science-backed frameworks in Impak.app.
                    \n\n\n\n
                    By utilizing our science-backed framework, you've maximized the impact of your research by focusing on generating valuable and truly useful data.
                    This data-driven approach promises to yield actionable insights that will empower you to make informed decisions and achieve your goals.
                    \n\n\n\n
                    We're excited to see the impactful outcomes your research will deliver!
                    Check your Dashboard > Surveys  to track real-time responses from your team.
                    ",
                    'toast' => false,
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'Okay',
                    'allowOutsideClick' => false,
                ]
            );

            Mail::to(Auth::user()->email)->queue(new SurveyCompletedMail(route('analytics')));
        }
    }

    public function analyzeSurvey()
    {
        if (empty($this->survey->rationale)) {
            $this->alert('warning', 'Rationale field cannot be empty');
            return;
        }

        if (strlen($this->survey->rationale) < 15) {
            $this->alert('warning', 'Rationale field must be at least 15 characters.');
            return;
        }

        if (empty($this->survey->rationale_description)) {
            $this->alert('warning', 'Rationale description field cannot be empty');
            return;
        }

        if (strlen($this->survey->rationale_description) < 100) {
            $this->alert('warning', 'Rationale description field must be at least 100 characters.');
            return;
        }

        if ($this->survey->survey_type == "others") {
            if (empty($this->survey->manual_survey_type)) {
                $this->alert('warning', 'Survey type must be specified.');
                return;
            }
        }

        dispatch(new ProcessGenerateSurvey($this->survey))->onConnection('database');
        // ProcessGenerateSurvey::dispatch($this->survey);

        $this->alert('success', 'Your survey will be generated in a few minutes.');
    }
}
