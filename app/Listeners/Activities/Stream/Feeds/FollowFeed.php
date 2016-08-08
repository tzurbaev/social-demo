<?php

namespace App\Listeners\Activities\Stream\Feeds;

use App\Events\Activities\Feeds\FeedFollowed;
use GetStream\Stream\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FollowFeed implements ShouldQueue
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
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Activities\Feeds\FeedFollowed  $event
     * @return void
     */
    public function handle(FeedFollowed $event)
    {
        $this->client->followFeed('flat', $event->feedId, 5);
    }
}
