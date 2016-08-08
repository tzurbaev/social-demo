<?php

namespace App\Listeners\Activities\Stream;

use App\Events\Event;
use GetStream\Stream\Client;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteActivity implements ShouldQueue
{
    /**
     * GetStream Client.
     *
     * @var \GetStream\Stream\Client
     */
    protected $client;

    /**
     * Create the event listener.
     *
     * @param \GetStream\Stream\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\Event $event
     */
    public function handle(Event $event)
    {
        $activityData = $event->activityData;

        $feed = $this->client->feed('user', $activityData['actor']);
        $feed->removeActivity($activityData['foreign_id'], true);
    }
}
