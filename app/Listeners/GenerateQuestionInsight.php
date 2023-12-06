<?php

namespace App\Listeners;

use App\Events\SurveyPublished;
use App\Models\QuestionQuant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use MattDaneshvar\Survey\Models\Answer;

class GenerateQuestionInsight
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SurveyPublished  $event
     * @return void
     */
    public function handle(SurveyPublished $event)
    {
        $survey = $event->survey;
        if($survey->publish_status != "closed") {
            return false;
        }

        foreach ($survey->questions as $question) {
            $questionId = $question->id;
            $quant = QuestionQuant::where('question_id', $questionId)->get();

            if(!$quant) {
                return false;
            } 

            $data = Answer::select('value')->selectRaw('COUNT(*) as count')->where('question_id', $questionId)->groupBy('value')->get();
            $dataset = $data->pluck('count', 'value')->toArray();

            
        }        
    }
}
