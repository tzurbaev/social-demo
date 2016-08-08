<?php

namespace App\Events\Activities\Comments;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CommentDeleted extends Event implements ShouldBroadcast
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
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->activityData = $comment->activityData();
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn(): array
    {
        return [
            'feed:'.$this->activityData['actor'],
            'comments:'.$this->activityData['commentable_type'].':'.$this->activityData['commentable_id'],
        ];
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
        return 'comment_deleted';
    }
}
