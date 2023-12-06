<?php

namespace App\Listeners;

use App\Events\SurveyPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateQuantifiableData
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

        info('Starting generating quantifiable data...' . $survey->publish_status);


        info('Generating quantifiable data...');
    }
}
