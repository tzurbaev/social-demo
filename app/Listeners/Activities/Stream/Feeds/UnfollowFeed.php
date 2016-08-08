<?php

namespace App\Listeners\Activities\Stream\Feeds;

use App\Events\Activities\Feeds\FeedUnfollowed;
use GetStream\Stream\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Handle the event.
     *
     * @param  FeedUnfollowed  $event
     * @return void
     */
    public function handle(FeedUnfollowed $event)
    {
        $this->client->unfollowFeed('flat', $event->feedId, true);
    }
}
