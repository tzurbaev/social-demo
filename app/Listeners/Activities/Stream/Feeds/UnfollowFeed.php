<?php

namespace App\Listeners\Activities\Stream\Feeds;

use App\Events\Activities\Feeds\FeedUnfollowed;
use GetStream\Stream\Client;
use Illuminate\Contracts\Queue\ShouldQueue;

class UnfollowFeed implements ShouldQueue
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
     * @param \App\Events\Activities\Feeds\FeedUnfollowed $event
     */
    public function handle(FeedUnfollowed $event)
    {
        $this->client->unfollowFeed('flat', $event->feedId, true);
    }
}
