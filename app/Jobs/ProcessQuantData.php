<?php

namespace App\Jobs;

use App\Models\QuestionQuant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class ProcessQuantData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public QuestionQuant $quant)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->quant;

        if($data->desc != null) {
            return false;
        }

        $questionId = $data->question->id;

        $systemPrompt = <<<PROMPT
        You analyze survey response data, and generating data description that spans 200 words or more.
        
        The rules to follow are:
        - No self-promotion
        - No offensive statements
        - Be confident in answering, even if given limited information
        - Do not repeat saying the survey question name, and type
        PROMPT;

        $userPrompt = <<<PROMPT
        Question name: {$data->question->content}
        Question type: {$data->question->type}
        Dataset: {$data->dataset}
        PROMPT;

        $data = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [[
                'role' => 'system',
                'content' => $systemPrompt,
            ], [
                'role' => 'user',
                'content' => $userPrompt,
            ]],
        ]);

        $response = $data['choices'][0]['message']['content'];
        QuestionQuant::updateOrCreate([
            'question_id' => $questionId
        ], [
           'desc' => $response,
        ]);
    }
}
