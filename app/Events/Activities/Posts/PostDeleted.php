<?php

namespace App\Events\Activities\Posts;

use App\Events\Event;
use App\Post;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class PostDeleted extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * Activity data.
     *
     * @var array
     */
    public $activityData;

    /**
     * Create a new event instance.
     */
    public function __construct(Post $post)
    {
        $this->activityData = $post->activityData();
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn(): array
    {
        return ['feed:'.$this->activityData['actor']];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return $this->activityData;
    }

    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'post_deleted';
    }
}
