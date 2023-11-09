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
            // new Template([
            //     'title' => 'Post Workshop: Measuring the Basics',
            //     'settings' => [
            //         'limit-per-participant' => 1,
            //         'accept-guest-entries' => false,
            //     ],
            //     'rationale' => 'Measure the key indicators for a successful initiative',
            //     'rationale_description' => trim("When one plans to roll-out training and development for the organization, one expects to gain improved skills and productivity, greater retention, and an improved brand (Verma, E. 2023, How to Measure Training Effectiveness in 2023). At the end of the workshop, participants are given questionnaires that will ask the effectivity of the training, application back at work and what other benefits were achieved. The answers help organizations assess if the training was a worthwhile investment of the organization.

            //     These are also the aim of this questionnaire. Primarily, it attempts to assess 2 areas of learning: 1. The initial impact of the workshop to the attendee and the relevance as applied to the individual role. The continuous feedback allows revisions to the design of the workshop."),
            //     "survey_type" => "post_workshop",
            //     "data" => [
            //         "Program/Workshop" => [
            //             "settings" => [
            //                 "sort_order" => 1,
            //             ],
            //             "How relevant was the program/workshop content to you?" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_relevancy'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 1,
            //             ],
            //             "How would you rate the activities in the program/workshop?" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_appropriateness'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 2,
            //             ],
            //             "How did the program/workshop respond to your current development needs?" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_timeliness'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 3,
            //             ],
            //             "Rate your level of knowledge on the subject matter before attending the program? Select and pin from 1 (no knowledge to 10 (with high level of knowledge and understanding)" => [
            //                 "type" => "range",
            //                 'options' => [
            //                     'Not likely',
            //                     'Most likely'
            //                 ],
            //                 'rules' => ['min:1', 'max:10'],
            //                 "sort_order" => 4,
            //             ],
            //             "Rate your level of knowledge on the subject matter after attending the program? Select and pin from 1 (no knowledge to 10 (with high level of knowledge and understanding)" => [
            //                 "type" => "range",
            //                 'options' => [
            //                     'Not likely',
            //                     'Most likely'
            //                 ],
            //                 'rules' => ['min:1', 'max:10'],
            //                 "sort_order" => 5,
            //             ]
            //         ],
            //         "Facilitator" => [
            //             "settings" => [
            //                 "sort_order" => 2,
            //             ],
            //             "Name of Main Facilitator" => [
            //                 "type" => "text",
            //                 "options" => [],
            //                 "rules" => ["required", "string", "max:250"],
            //                 "sort_order" => 1,
            //             ],
            //             "How would you rate the level of expertise that the program host/main facilitator exhibited during the session?" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_knowledgeability'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 2,
            //             ],
            //             "Name of Co-Facilitator" => [
            //                 "type" => "text",
            //                 "options" => [],
            //                 "rules" => ["nullable", "string", "max:250"],
            //                 "sort_order" => 3,
            //             ],
            //             "How would you rate the level of expertise that the program host/2nd facilitator exhibited during the session?" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_knowledgeability'),
            //                 "rules" => ["nullable"],
            //                 "sort_order" => 4,
            //             ]
            //         ],
            //         "Learning Environment" => [
            //             "settings" => [
            //                 "sort_order" => 3,
            //             ],
            //             "How would you rate the platform program/cascade/training session?" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_satisfaction'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 1,
            //             ],
            //             "How would you rate the learning materials provided to you?" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_completeness'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 2,
            //             ],
            //         ],
            //         "Overall Rating" => [
            //             "settings" => [
            //                 "sort_order" => 4,
            //             ],
            //             "Rate your over-all experience of the program" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_satisfaction'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 1,
            //             ],
            //             "How like would you recommend this program to your peers/managers and teammates" => [
            //                 "type" => "range",
            //                 'options' => [
            //                     'Not likely',
            //                     'Most likely'
            //                 ],
            //                 'rules' => ['min:1', 'max:10'],
            //                 "sort_order" => 2,
            //             ]
            //         ],
            //     ]
            // ]),
            // new Template([
            //     'title' => 'Post Event: Measuring the Basics',
            //     'settings' => [
            //         'limit-per-participant' => 1,
            //         'accept-guest-entries' => false,
            //     ],
            //     'rationale' => 'Measure the key indicators for a successful initiative',
            //     'rationale_description' => trim("The event evaluation survey measures the feedback of participants to the event with the intent to make necessary improvements.
            //     It could either be an indicator of future partnerships or, similar programs to role out. Through this assessment, organizers can find out if the session was good enough; the event was informative or not, presentation skills of the speaker, event venue, and so on."),
            //     "survey_type" => "post_event",
            //     "data" => [
            //         "Event Name" => [
            //             "settings" => [
            //                 "sort_order" => 1,
            //             ],
            //             "How would you rate the entire event?" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_excellency'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 1,
            //             ],
            //             "How well did this event meet your expectations?" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('5_wellness'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 2,
            //             ],
            //             "What are the likelihood that you will attend this event, or a similar one, again?" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('3_tristate'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 3,
            //             ],
            //             "What did you MOST LIKE about the event?" => [
            //                 "type" => "text",
            //                 "options" => [],
            //                 "rules" => ["required", "string", "max:1000"],
            //                 "sort_order" => 4,
            //             ],
            //             "What did you LEAST LIKE about the event?" => [
            //                 "type" => "text",
            //                 "options" => [],
            //                 "rules" => ["required", "string", "max:1000"],
            //                 "sort_order" => 5,
            //             ],
            //             "How much impact will this event have on your learning goals?" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_impact'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 6,
            //             ],
            //             "What other comments/suggestions do you have for us?" => [
            //                 "type" => "text",
            //                 "options" => [],
            //                 "rules" => ["required", "string", "max:1000"],
            //                 "sort_order" => 7,
            //             ],
            //         ],
            //         "How would you rate the event in the area of:" => [
            //             "settings" => [
            //                 "sort_order" => 2,
            //             ],
            //             "Announcements/Commercials" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_satisfaction'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 1,
            //             ],
            //             "Joining Instructions" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_satisfaction'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 2,
            //             ],
            //             "Registration" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_satisfaction'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 3,
            //             ],
            //             "Staff" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_satisfaction'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 4,
            //             ],
            //             "Speakers" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_satisfaction'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 5,
            //             ],
            //             "Content" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_satisfaction'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 6,
            //             ],
            //             "Venue" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_satisfaction'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 7,
            //             ],
            //             "Time" => [
            //                 "type" => "radio",
            //                 "options" => $this->chooseTemplate('4_satisfaction'),
            //                 "rules" => ["required"],
            //                 "sort_order" => 8,
            //             ],
            //         ],
            //         "Overall Rating" => [
            //             "settings" => [
            //                 "sort_order" => 3,
            //             ],
            //             "Considering your over-all experience, how likely are you to recommend this event to your friends and colleague?" => [
            //                 "type" => "range",
            //                 'options' => [
            //                     'Not likely',
            //                     'Most likely'
            //                 ],
            //                 'rules' => ['min:1', 'max:10'],
            //                 "sort_order" => 1,
            //             ]
            //         ]
            //     ]
            // ])
            new Template([
                'title' => 'Mood Tracker',
                'settings' => [
                    'limit-per-participant' => 1,
                    'accept-guest-entries' => false,
                ],
                'rationale' => 'A mood tracker framework is a system for tracking your mood over time. It aims to help you identify patterns in your mood and factors that affect your emotions.',
                'rationale_description' => trim("Mood tracking is a valuable tool that can be used to improve employee well-being, productivity, and engagement. Organizations that are interested in improving the mental health and performance of their employees should consider implementing mood-tracking programs.
                Mood is a temporary state of mind that can be affected by a variety of factors, such as your work environment, your personal life, and your overall health.
                Participants will be asked to answer a 10-item mood tracker questionnaire. It aims to check the current mood of the employees. The responses will help the organization create employee engagement activities to help reduce stress in the workplace."),
                "survey_type" => "mental_health",
                "data" => [
                    "Questionnaire" => [
                        "settings" => [
                            "sort_order" => 1,
                        ],
                        "How would you rate your overall mood today?" => [
                            "type" => "range",
                            'options' => [
                                'Very bad',
                                'Very good'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 1,
                        ],
                        "How much energy do you have today?" => [
                            "type" => "range",
                            'options' => [
                                'Very Tired',
                                'Super Energized'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 2,
                        ],
                        "How would you rate your concentration levels today?" => [
                            "type" => "range",
                            'options' => [
                                'Distracted',
                                'Focused'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 3,
                        ],
                        "How productive have you been today?" => [
                            "type" => "range",
                            'options' => [
                                'Very unproductive',
                                'Very productive'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 4,
                        ],
                        "How stressed are you feeling today?" => [
                            "type" => "range",
                            'options' => [
                                'Highly stressed',
                                'Not stressed at all'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 5,
                        ],
                        "How happy are you today?" => [
                            "type" => "range",
                            'options' => [
                                'Very unhappy',
                                'Very happy'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 6,
                        ],
                        "How connected do you feel to your colleagues today?" => [
                            "type" => "range",
                            'options' => [
                                'Very disconnected',
                                'Very connected'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 7,
                        ],
                        "How supported do you feel by your manager today?" => [
                            "type" => "range",
                            'options' => [
                                'Very unsupported',
                                'Very supported'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 8,
                        ],
                        "How satisfied are you with your work today?" => [
                            "type" => "range",
                            'options' => [
                                'Very dissatisfied',
                                'Very satisfied'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 9,
                        ],
                        "How would you rate your overall sense of well-being today?" => [
                            "type" => "range",
                            'options' => [
                                'Very low',
                                'Very high'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 10,
                        ],
                    ],
                    "Open ended questions" => [
                        "settings" => [
                            "sort_order" => 2,
                        ],
                        "What could your organization do to improve your mood?" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["required", "string", "max:1000"],
                            "sort_order" => 1,
                        ],
                        "Is there anything else you would like to share about your mood today?" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["nullable", "string", "max:250"],
                            "sort_order" => 2,
                        ],
                        "What were you doing immediately before taking this survey?" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["required", "string", "max:250"],
                            "sort_order" => 3,
                        ],
                    ],
                ]
            ]),
            new Template([
                'title' => 'Optimism Test',
                'settings' => [
                    'limit-per-participant' => 1,
                    'accept-guest-entries' => false,
                ],
                'rationale' => 'The Optimism Test is a valuable tool for understanding and measuring the current state of optimism in employees.',
                'rationale_description' => trim("It can be used to identify people who are at risk for depression and other mental health problems, to help people to learn optimism and to evaluate the effectiveness of interventions designed to increase optimism. The survey can also be used to research the relationship between explanatory style and other variables, such as health, happiness, and success."),
                "survey_type" => "mental_health",
                "data" => [
                    "Questionnaire" => [
                        "settings" => [
                            "sort_order" => 1,
                        ],
                        "I expect good things to happen to me in general." => [
                            "type" => "range",
                            'options' => [
                                'I\'m discouraged',
                                'I\'m hopeful'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 1,
                        ],
                        "I believe that I am a lucky person." => [
                            "type" => "range",
                            'options' => [
                                'I\'m unlucky',
                                'I\'m lucky'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 2,
                        ],
                        "I am able to bounce back from setbacks quickly." => [
                            "type" => "range",
                            'options' => [
                                'I\'m easily defeated',
                                'I\'m resilient'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 3,
                        ],
                        "I stay positive even when things are tough." => [
                            "type" => "range",
                            'options' => [
                                'I\'m easily upset',
                                'I\'m unfazed'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 4,
                        ],
                        "I believe that my successes are due to my own efforts and abilities." => [
                            "type" => "range",
                            'options' => [
                                'Definitely not',
                                'Absolutely!'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 5,
                        ],
                        "I believe that my failures are due to temporary factors or bad luck." => [
                            "type" => "range",
                            'options' => [
                                'It\'s out of my control',
                                'I can make my own choices'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 6,
                        ],
                        "I expect bad things to happen to me in general." => [
                            "type" => "range",
                            'options' => [
                                'I am cursed',
                                'I am blessed'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 7,
                        ],
                        "I believe that I am an unlucky person." => [
                            "type" => "range",
                            'options' => [
                                'I\'m out of luck',
                                'I\'m very fortunate',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 8,
                        ],
                        "I find it difficult to bounce back from setbacks." => [
                            "type" => "range",
                            'options' => [
                                'I\'m slow to recover',
                                'I bounce back easily',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 9,
                        ],
                        "I tend to get discouraged easily." => [
                            "type" => "range",
                            'options' => [
                                'I\'m easily discouraged',
                                'I\'m inspired',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 10,
                        ],
                        "I believe that my successes are due to luck or help from others." => [
                            "type" => "range",
                            'options' => [
                                'I don\'t get the breaks I need',
                                'I am responsible for my success',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 11,
                        ],
                        "I believe that my successes are due to luck or help from others." => [
                            "type" => "range",
                            'options' => [
                                'I don\'t get the breaks I need',
                                'I am responsible for my success',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 11,
                        ],
                        "I believe that my failures are due to my own lack of ability." => [
                            "type" => "range",
                            'options' => [
                                'I don\'t have what it takes',
                                'I can achieve my goals if I work hard',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 12,
                        ],
                        "I am optimistic about my future." => [
                            "type" => "range",
                            'options' => [
                                'The future is gloomy',
                                'The future is bright',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 13,
                        ],
                        "I am confident in my ability to achieve my goals." => [
                            "type" => "range",
                            'options' => [
                                'I\'m not sure',
                                'Yes, I can!',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 14,
                        ],
                        "I believe that I can control my own destiny." => [
                            "type" => "range",
                            'options' => [
                                'I have no choice',
                                'I\'m in control',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 15,
                        ],
                        "I am hopeful about the future." => [
                            "type" => "range",
                            'options' => [
                                'No',
                                'Yes!',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 16,
                        ],
                        "I am positive about the world." => [
                            "type" => "range",
                            'options' => [
                                'The world is a bad place',
                                'The world is a good place',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 17,
                        ],
                        "I am optimistic about my chances of success." => [
                            "type" => "range",
                            'options' => [
                                'I\'m doomed to fail',
                                'I\'m confident I will succeed',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 18,
                        ],
                        "I believe that I can overcome any obstacle." => [
                            "type" => "range",
                            'options' => [
                                'I can\'t handle it',
                                'I\'m a problem solver',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 19,
                        ],
                        "I am confident in my ability to handle challenges." => [
                            "type" => "range",
                            'options' => [
                                'I don\'t know if I can handle challenges',
                                'I can handle anything that comes my way',
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 20,
                        ],
                    ],
                ]
            ]),
            new Template([
                'title' => 'Kirkpatrick Level 1 Assessment',
                'settings' => [
                    'limit-per-participant' => 1,
                    'accept-guest-entries' => false,
                ],
                'rationale' => 'This framework is important for organizations because it provides feedback on the training experience, builds trust and rapport with learners, and can help to justify the investment in training.',
                'rationale_description' => trim("Organizations can use Level 1 assessment to identify areas for improvement, gauge the effectiveness of training delivery methods, assess the overall quality of the training experience, identify high-performing trainers, track trends over time, and communicate the value of training to stakeholders."),
                "survey_type" => "training_needs",
                "data" => [
                    "Program/Workshop" => [
                        "settings" => [
                            "sort_order" => 1,
                        ],
                        "How relevant was the program/workshop content to you?" => [
                            "type" => "range",
                            'options' => [
                                'Very relevant',
                                'Not relevant'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 1,
                        ],
                        "How would you rate the activities in the program/ workshop?" => [
                            "type" => "range",
                            'options' => [
                                'Very appopriate',
                                'Not appopriate at all'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 2,
                        ],
                        "How did the program/workshop respond to your current development needs?" => [
                            "type" => "range",
                            'options' => [
                                'Very timely and responsive',
                                'Not at all'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 3,
                        ],
                        "Rate your level of knowledge on the subject matter BEFORE attending the program?" => [
                            "type" => "range",
                            'options' => [
                                'No knowledge',
                                'With high level of knowledge and understanding'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 4,
                        ],
                        "Rate your level of knowledge on the subject matter AFTER attending the program?" => [
                            "type" => "range",
                            'options' => [
                                'No knowledge',
                                'With high level of knowledge and understanding'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 5,
                        ],
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
                        "How would you rate the level of expertise that the main facilitator exhibited during the session?" => [
                            "type" => "range",
                            'options' => [
                                'Not knowledgeable',
                                'Very knowledgeable'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 2,
                        ],
                    ],
                    "Learning Environment" => [
                        "settings" => [
                            "sort_order" => 3,
                        ],
                        "How would you rate the platform used during the program/cascade/training session?" => [
                            "type" => "range",
                            'options' => [
                                'Not appropriate',
                                'Very appropriate'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 1,
                        ],
                        "How would you rate the level of expertise that the main facilitator exhibited during the session?" => [
                            "type" => "range",
                            'options' => [
                                'Lacks details and incomplete',
                                'Very detailed and complete'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 2,
                        ],
                    ],
                    "Overall Rating" => [
                        "settings" => [
                            "sort_order" => 4,
                        ],
                        "Please rate your over-all experience with the program." => [
                            "type" => "range",
                            'options' => [
                                'Waste of time',
                                'Amazing!'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 1,
                        ],
                        "How likely will you recommend this program to your peers/managers and teammates?" => [
                            "type" => "range",
                            'options' => [
                                'Will not recommend',
                                'Will highly recommend'
                            ],
                            'rules' => ['min:1', 'max:10'],
                            "sort_order" => 2,
                        ],
                    ],
                    "Other comments" => [
                        "settings" => [
                            "sort_order" => 5,
                        ],
                        "What went well during the program?" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["required", "string", "max:1000"],
                            "sort_order" => 1,
                        ],
                        "What can be improved?" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["required", "string", "max:1000"],
                            "sort_order" => 2,
                        ],
                        "What follow-up activities or programs would you like to attend to further deepen your knowledge and skills?" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["required", "string", "max:1000"],
                            "sort_order" => 3,
                        ],
                        "Other comments?" => [
                            "type" => "text",
                            "options" => [],
                            "rules" => ["nullable", "string", "max:250"],
                            "sort_order" => 4,
                        ],
                    ],
                ]
            ]),
        ];

        foreach ($data as $template) {
            $template->save();
        }
    }
}
