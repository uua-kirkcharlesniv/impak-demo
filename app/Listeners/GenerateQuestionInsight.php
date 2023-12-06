<?php

namespace App\Listeners;

use App\Events\SurveyPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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

        info('Generating insights');
    }
}
