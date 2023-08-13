<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use OpenAI\Laravel\Facades\OpenAI;

class GPTGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gpt:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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
                'content' => "
                Survey Type: Post Event Questionnaire
                Rationale: Aim to measure the key indicators for a successful initiative.
                Description: When one plans to roll-out training and development for the organization, one expects to gain improved skills and
                productivity, greater retention, and an improved brand (Verma, E. 2023, How to Measure Training Effectiveness in
                2023). At the end of the workshop, participants are given questionnaires that will ask the effectivity of the training,
                application back at work and what other benefits were achieved. The answers help organizations assess if the
                training was a worthwhile investment of the organization.
                These are also the aim of this questionnaire. Primarily, it attempts to assess 2 areas of learning: 1. The initial impact
                of the workshop to the attendee and the relevance as applied to the individual role. The continuous feedback allows
                revisions to the design of the workshop.
                ",
            ]],
        ]);

        // dd($data);



        return Command::SUCCESS;
    }
}
