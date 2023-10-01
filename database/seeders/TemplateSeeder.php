<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class TemplateSeeder extends Seeder
{
    private function chooseTemplate($template)
    {
        $choices = [];

        switch ($template) {
            case '8_truth':
                $choices = [
                    'Definitely False',
                    'Mostly False',
                    'Somewhat False',
                    'Slightly False',
                    'Slightly True',
                    'Somewhat True',
                    'Mostly True',
                    'Definitely True',
                ];
                break;
            case '5_wellness':
                $choices = [
                    'Very well',
                    'Well',
                    'Neutral',
                    'Not much',
                    'Hardly',
                ];

                break;
            case '4_relevancy':
                $choices = [
                    'Very relevant',
                    'Somewhat relevant',
                    'Not much relevant',
                    'Not relevant',
                ];
                break;
            case '4_appropriateness':
                $choices = [
                    'Very much appropriate',
                    'Appropriate',
                    'Not much appropriate',
                    'Not appropriate at all',
                ];
                break;
            case '4_timeliness':
                $choices = [
                    'Very timely and responsive',
                    'Somewhat timely',
                    'Not much',
                    'Not at all',
                ];
                break;
            case '4_knowledgeability':
                $choices = [
                    'Very much knowledgeable',
                    'Knowledgeable',
                    'Not much knowledgeable',
                    'Not knowledgeable',
                ];
                break;
            case '4_satisfaction':
                $choices = [
                    'Very satisfied',
                    'Satisfied',
                    'Dissatisfied',
                    'Very dissatisfied',
                ];
                break;
            case '4_excellency':
                $choices = [
                    'It was excellent!',
                    'Just ok',
                    'There were portions not good',
                    'Not good at all',
                ];
                break;
            case '4_impact':
                $choices = [
                    'Very much',
                    'Somewhat',
                    'Hardly',
                    'No impact',
                ];
                break;
            case '4_completeness':
                $choices = [
                    'Very detailed and complete',
                    'Complete',
                    'Not complete',
                    'Not detailed and complete all',
                ];
                break;
            case '3_completeness':
                $choices = [
                    'Complete',
                    'Not complete',
                    'Not detailed and complete all',
                ];
                break;
            case '3_tristate':
                $choices = [
                    'Yes',
                    'Can\'t Say',
                    'No',
                ];
                break;
        }

        return $choices;
    }

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
                'rationale_description' => trim("When one plans to roll-out training and development for the organization, one expects to gain improved skills and productivity, greater retention, and an improved brand (Verma, E. 2023, How to Measure Training Effectiveness in 2023). At the end of the workshop, participants are given questionnaires that will ask the effectivity of the training, application back at work and what other benefits were achieved. The answers help organizations assess if the training was a worthwhile investment of the organization.

                These are also the aim of this questionnaire. Primarily, it attempts to assess 2 areas of learning: 1. The initial impact of the workshop to the attendee and the relevance as applied to the individual role. The continuous feedback allows revisions to the design of the workshop."),
                "survey_type" => "post_workshop",
                "data" => [
                    "Program/Workshop" => [
                        "settings" => [
                            "sort_order" => 1,
                        ],
                        "How relevant was the program/workshop content to you?" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_relevancy'),
                            "rules" => ["required"],
                            "sort_order" => 1,
                        ],
                        "How would you rate the activities in the program/workshop?" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_appropriateness'),
                            "rules" => ["required"],
                            "sort_order" => 2,
                        ],
                        "How did the program/workshop respond to your current development needs?" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_timeliness'),
                            "rules" => ["required"],
                            "sort_order" => 3,
                        ],
                        "Rate your level of knowledge on the subject matter before attending the program? Select and pin from 1 (no knowledge to 10 (with high level of knowledge and understanding)" => [
                            "type" => "range",
                            'options' => [
                                'Not likely',
                                'Most likely'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 4,
                        ],
                        "Rate your level of knowledge on the subject matter after attending the program? Select and pin from 1 (no knowledge to 10 (with high level of knowledge and understanding)" => [
                            "type" => "range",
                            'options' => [
                                'Not likely',
                                'Most likely'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 5,
                        ]
                    ],
                    "Facilitator" => [
                        "settings" => [
                            "sort_order" => 2,
                        ],
                        "Name of Main Facilitator" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["required", "string", "max:250"],
                            "sort_order" => 1,
                        ],
                        "How would you rate the level of expertise that the program host/main facilitator exhibited during the session?" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_knowledgeability'),
                            "rules" => ["required"],
                            "sort_order" => 2,
                        ],
                        "Name of Co-Facilitator" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["string", "max:250"],
                            "sort_order" => 3,
                        ],
                        "How would you rate the level of expertise that the program host/2nd facilitator exhibited during the session?" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_knowledgeability'),
                            "rules" => [],
                            "sort_order" => 4,
                        ]
                    ],
                    "Learning Environment" => [
                        "settings" => [
                            "sort_order" => 3,
                        ],
                        "How would you rate the platform program/cascade/training session?" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_satisfaction'),
                            "rules" => ["required"],
                            "sort_order" => 1,
                        ],
                        "How would you rate the learning materials provided to you?" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_completeness'),
                            "rules" => ["required"],
                            "sort_order" => 2,
                        ],
                    ],
                    "Overall Rating" => [
                        "settings" => [
                            "sort_order" => 4,
                        ],
                        "Rate your over-all experience of the program" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_satisfaction'),
                            "rules" => ["required"],
                            "sort_order" => 1,
                        ],
                        "How like would you recommend this program to your peers/managers and teammates" => [
                            "type" => "range",
                            'options' => [
                                'Not likely',
                                'Most likely'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 2,
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
                'rationale_description' => trim("The event evaluation survey measures the feedback of participants to the event with the intent to make necessary improvements.
                It could either be an indicator of future partnerships or, similar programs to role out. Through this assessment, organizers can find out if the session was good enough; the event was informative or not, presentation skills of the speaker, event venue, and so on."),
                "survey_type" => "post_event",
                "data" => [
                    "Event Name" => [
                        "settings" => [
                            "sort_order" => 1,
                        ],
                        "How would you rate the entire event?" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_excellency'),
                            "rules" => ["required"],
                            "sort_order" => 1,
                        ],
                        "How well did this event meet your expectations?" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('5_wellness'),
                            "rules" => ["required"],
                            "sort_order" => 2,
                        ],
                        "What are the likelihood that you will attend this event, or a similar one, again?" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('3_tristate'),
                            "rules" => ["required"],
                            "sort_order" => 3,
                        ],
                        "What did you MOST LIKE about the event?" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["required", "string", "max:1000"],
                            "sort_order" => 4,
                        ],
                        "What did you LEAST LIKE about the event?" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["required", "string", "max:1000"],
                            "sort_order" => 5,
                        ],
                        "How much impact will this event have on your learning goals?" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_impact'),
                            "rules" => ["required"],
                            "sort_order" => 6,
                        ],
                        "What other comments/suggestions do you have for us?" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["required", "string", "max:1000"],
                            "sort_order" => 7,
                        ],
                    ],
                    "How would you rate the event in the area of:" => [
                        "settings" => [
                            "sort_order" => 2,
                        ],
                        "Announcements/Commercials" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_satisfaction'),
                            "rules" => ["required"],
                            "sort_order" => 1,
                        ],
                        "Joining Instructions" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_satisfaction'),
                            "rules" => ["required"],
                            "sort_order" => 2,
                        ],
                        "Registration" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_satisfaction'),
                            "rules" => ["required"],
                            "sort_order" => 3,
                        ],
                        "Staff" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_satisfaction'),
                            "rules" => ["required"],
                            "sort_order" => 4,
                        ],
                        "Speakers" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_satisfaction'),
                            "rules" => ["required"],
                            "sort_order" => 5,
                        ],
                        "Content" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_satisfaction'),
                            "rules" => ["required"],
                            "sort_order" => 6,
                        ],
                        "Venue" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_satisfaction'),
                            "rules" => ["required"],
                            "sort_order" => 7,
                        ],
                        "Time" => [
                            "type" => "radio",
                            "options" => $this->chooseTemplate('4_satisfaction'),
                            "rules" => ["required"],
                            "sort_order" => 8,
                        ],
                    ],
                    "Overall Rating" => [
                        "settings" => [
                            "sort_order" => 3,
                        ],
                        "Considering your over-all experience, how likely are you to recommend this event to your friends and colleague?" => [
                            "type" => "range",
                            'options' => [
                                'Not likely',
                                'Most likely'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 1,
                        ]
                    ]
                ]
            ])
        ];

        foreach ($data as $template) {
            $template->save();
        }
    }
}
