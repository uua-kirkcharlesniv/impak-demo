<?php

namespace App\Jobs;

use App\Models\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class ProcessGenerateSurvey implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $survey;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rationale = $this->survey->rationale;
        $description = $this->survey->rationale_description;
        $surveyType = '';
        $sections = '';
        $subspec = '';

        if ($this->survey->survey_type == 'others') {
            $surveyType = $this->survey->manual_survey_type;

            if (!empty($this->survey->manual_sections)) {
                $sections = 'Sections: ' . $this->survey->manual_sections . '\n';
            }
        } else {
            $var = strtolower(str_replace('_', ' ', $this->survey->survey_type));

            $surveyType = ucwords($var);
        }

        if (!empty($this->survey->target_focus)) {
            $subspec = 'Target Focus: ' . $this->survey->target_focus . '\n';
        }

        Log::debug('Processing ' . $this->survey->name . ' from: ' . tenant()->company);

        $prompt = trim("Survey Type: $surveyType
        Rationale: $rationale
        Description: $description
        $sections
        $subspec");

        Log::debug($prompt);


        $data = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [[
                'role' => 'system',
                'content' => <<<PROMPT
                You are a Survey AI tool that helps to generate sections, and in each section there would be questions.

                The only rules to follow are:
                - No self-promotion
                - No offensive statements
                - Generate at least 3 sections, and 3 questions within them, maximum of 6 sections, and 6 questions within them.

                Reply following the sample JSON:

                [
                    {
                        "section_name": "Test",
                        "questions": [
                            {
                                "question_name": "Question Name",
                                "type": "text"
                            }
                        ]
                    }
                ]

                The following types can be:
                - text
                - radio
                - multiselect

                If type is radio OR multiselect, the question object must have a "options" key, with value of a string array.
                PROMPT,
            ], [
                'role' => 'user',
                'content' => $prompt,
            ]],
        ]);
        Log::debug('RECEIVED RESPONSE!!!');

        Log::debug($data['choices'][0]['message']['content']);

        $data = json_decode($data['choices'][0]['message']['content'], true);


        foreach ($data as $parsedSections) {
            $section = $this->survey->sections()->create(['name' => $parsedSections['section_name']]);

            foreach ($parsedSections['questions'] as $question) {
                Log::warning('Processing type of ' . $question['type'] . ' - ' . $question['question_name']);

                switch ($question['type']) {
                    case 'text':
                        $section->questions()->create([
                            'content' => $question['question_name'],
                            'type' => 'text',
                            'rules' => ['required', 'string', 'max:250'],
                        ]);
                        break;
                    case 'radio':
                        $section->questions()->create([
                            'content' => $question['question_name'],
                            'type' => 'radio',
                            'rules' => ['required'],
                            'options' => $question['options'],
                        ]);
                        break;
                    case 'multiselect':
                        $section->questions()->create([
                            'content' => $question['question_name'],
                            'type' => 'multiselect',
                            'rules' => ['required', 'array', 'max:2'],
                            'options' => $question['options'],
                        ]);
                        break;

                    default:
                        Log::warning('Unsupported type! ' . $question['type']);
                        break;
                }
            }
        }
    }
}
