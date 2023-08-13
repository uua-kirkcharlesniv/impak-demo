<?php

namespace App\Events;

use App\Models\Survey;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SurveyGenerated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $tenantId;
    public $surveyId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($tenantId, $surveyId)
    {
        $this->tenantId = $tenantId;
        $this->surveyId = $surveyId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->tenantId . '.surveys.' . $this->surveyId);
    }
}
