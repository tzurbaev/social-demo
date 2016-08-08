<?php

namespace App\Events\Activities\Feeds;

use App\Events\Event;
use App\User;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class FeedUnfollowed extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * Feed ID.
     *
     * @param int
     */
    public $feedId;

    /**
     * Follower.
     *
     * @var \App\User
     */
    public $follower;

    /**
     * Create a new event instance.
     *
     * @param int       $feedId
     * @param \App\User $follower
     */
    public function __construct(int $feedId, User $follower)
    {
        $this->feedId = $feedId;
        $this->follower = $follower;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['user:'.$this->follower->id];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'feedId' => $this->feedId,
        ];
    }

    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'feed_unfollowed';
    }
}
