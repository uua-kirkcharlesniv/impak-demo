<?php

namespace App\Listeners;

use App\Events\QuantDataPublished;
use App\Jobs\ProcessQuantData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class GenerateInsightFromQuant implements ShouldQueue
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
     * @param  \App\Events\QuantDataPublished  $event
     * @return void
     */
    public function handle(QuantDataPublished $event)
    {
        $data = $event->quant;

        if($data->desc != null) {
            return false;
        }

        info('Generating quant data for ' . $data->question->content);

        ProcessQuantData::dispatch($data);
    }
}
