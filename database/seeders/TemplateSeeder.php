<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class TemplateSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            new Template([
                'title' => 'Post Workshop: Measuring the Basics',
                'settings' => [
                    'limit-per-participant' => 1,
                    'accept-guest-entries' => false,
                ],
                'rationale' => 'Measure the key indicators for a successful initiative',
                'rationale_description' => trim("
                When one plans to roll-out training and development for the organization, one expects to gain improved skills and
                productivity, greater retention, and an improved brand (Verma, E. 2023, How to Measure Training Effectiveness in
                2023). At the end of the workshop, participants are given questionnaires that will ask the effectivity of the training,
                application back at work and what other benefits were achieved. The answers help organizations assess if the
                training was a worthwhile investment of the organization.
                These are also the aim of this questionnaire. Primarily, it attempts to assess 2 areas of learning: 1. The initial impact
                of the workshop to the attendee and the relevance as applied to the individual role. The continuous feedback allows
                revisions to the design of the workshop.
                "),
                "survey_type" => "post_workshop",
                "data" => [
                    "Program/Workshop" => [
                        "How relevant was the program/workshop content to you?" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "How would you rate the activities in the program/workshop?" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "How did the program/workshop respond to your current development needs?" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "Rate your level of knowledge on the subject matter before attending the program? Select and pin from 1 (no knowledge to 10 (with high level of knowledge and understanding)" => [
                            "type" => "range",
                            "options" => ["start:1", "end:10"],
                            "rules" => ["required", "digits_between:1,10"]
                        ],
                        "Rate your level of knowledge on the subject matter after attending the program? Select and pin from 1 (no knowledge to 10 (with high level of knowledge and understanding)" => [
                            "type" => "range",
                            "options" => ["start:1", "end:10"],
                            "rules" => ["required", "digits_between:1,10"]
                        ]
                    ],
                    "Facilitator" => [
                        "Name of Main Facilitator" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["required", "string", "max:250"]
                        ],
                        "How would you rate the level of expertise that the program host/main facilitator exhibited during the session?" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ]
                    ],
                    "Learning Environment" => [
                        "How would you rate the platform program/cascade/training session?" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "How would you rate the learning materials provided to you?" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                    ],
                    "Overall Rating" => [
                        "Rate your over-all experience of the program" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "How like would you recommend this program to your peers/managers and teammates" => [
                            "type" => "range",
                            "options" => ["start:1", "end:10"],
                            "rules" => ["required", "digits_between:1,10"]
                        ]
                    ],
                ]
            ]),
            new Template([
                'title' => 'Post Event: Measuring the Basics',
                'settings' => [
                    'limit-per-participant' => 1,
                    'accept-guest-entries' => false,
                ],
                'rationale' => 'Measure the key indicators for a successful initiative',
                'rationale_description' => trim("
                The event evaluation survey measures the feedback of participants to the event with the intent to make necessary
                improvements. It could either be an indicator of future partnerships or, similar programs to role out. Through this
                assessment, organizers can find out if the session was good enough; the event was informative or not, presentation
                skills of the speaker, event venue, and so on.
                "),
                "survey_type" => "post_event",
                "data" => [
                    "Event Name" => [
                        "How would you rate the entire event?" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "How well did this event meet your expectations?" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "What are the likelihood that you will attend this event, or a similar one, again?" => [
                            "type" => "likert",
                            "options" => ["tristate", "asc"],
                            "rules" => ["required"],
                        ],
                        "How would you rate the event in the area of: Announcements/Commercials" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "How would you rate the event in the area of: Joining Instructions" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "How would you rate the event in the area of: Registration" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "How would you rate the event in the area of: Staff" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "How would you rate the event in the area of: Speakers" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "How would you rate the event in the area of: Content" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "How would you rate the event in the area of: Venue" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "How would you rate the event in the area of: Time" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "What did you MOST LIKE about the event?" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["required", "string", "max:1000"]
                        ],
                        "What did you LEAST LIKE about the event?" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["required", "string", "max:1000"]
                        ],
                        "How much impact will this event have on your learning goals?" => [
                            "type" => "likert",
                            "options" => ["full", "asc"],
                            "rules" => ["required"],
                        ],
                        "What other comments/suggestions do you have for us?" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["required", "string", "max:1000"]
                        ],
                    ],
                    "Overall Rating" => [
                        "Considering your over-all experience, how likely are you to recommend this event to your friends and colleague?" => [
                            "type" => "range",
                            "options" => ["start:1", "end:10"],
                            "rules" => ["required", "digits_between:1,10"]
                        ]
                    ]
                ]
            ])
        ];

        foreach($data as $template) {
            $template->save();
        }
    }
}
