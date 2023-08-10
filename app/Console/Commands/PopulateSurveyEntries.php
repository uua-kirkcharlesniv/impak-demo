<?php

namespace App\Console\Commands;

use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use MattDaneshvar\Survey\Models\Entry;
use Stancl\Tenancy\Concerns\HasATenantsOption;
use Stancl\Tenancy\Concerns\TenantAwareCommand;

class PopulateSurveyEntries extends Command
{
    // use TenantAwareCommand, HasATenantsOption;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'survey:populate {tenant_id} {survey_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate survey entries';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $this->output->write('my inline message', false);
        tenancy()->find($this->argument('tenant_id'))->run(function () {
            $survey = Survey::findOrFail($this->argument('survey_id'));

            $this->output->write('Populating ' . $survey->name . '...', true);
            foreach ($survey->target_user_ids as $id) {
                $user = User::findOrFail($id);
                $this->output->write('Answering for ' . $user->name . '...', true);

                $answers = [];
                foreach ($survey->questions as $question) {
                    $answers[$question->key] = $this->generateRandomAnswer($question);
                }

                $validator = Validator::make($answers, $survey->rules);

                if ($validator->fails()) {
                    foreach ($validator->errors()->all() as $error) {
                        $this->error($error);
                    }
                    return;
                }


                (new Entry)->for($survey)->by($user)->fromArray($answers)->push();
            }
        });
        // $this->output->write('survey count: ' . Survey::all()->count(), false);

        return Command::SUCCESS;
    }

    protected function generateRandomAnswer(Question $question)
    {
        switch ($question->type) {
            case 'long-answer':
            case 'short-answer':
                return 'This is a randomly generated data!';
                break;
            case 'date':
                return '2020-01-01';
                break;
            case 'time':
                return '08:00';
                break;
            case 'radio':
                $random = array_rand($question->options, 1);
                return $question->options[$random];
                break;
            case 'likert':
                $data = generateLikertNames($question->likert_type, $question->likert_order);
                $random = array_rand($data, 1);
                return $data[$random];
                break;
            case 'multiselect':
                $array = [];
                $min = $question->min ?? 1;
                if ($min > 1) {
                    foreach (array_rand($question->options, $min) as $key) {
                        array_push($array, $question->options[$key]);
                    }
                    return $array;
                } else {
                    $random = array_rand($question->options, 1);
                    return [$question->options[$random]];
                }
                break;
            case 'range':
                return rand(1, 10);
                break;
            default:
                break;
        }
    }
}
