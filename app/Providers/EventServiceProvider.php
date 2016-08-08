<?php

namespace App\Providers;

use App\Comment;
use App\Events\Activities\Comments\CommentCreated;
use App\Events\Activities\Comments\CommentDeleted;
use App\Events\Activities\Posts\PostCreated;
use App\Events\Activities\Posts\PostDeleted;
use App\Post;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Activities\Posts\PostCreated' => [
            'App\Listeners\Activities\Stream\CreateActivity',
        ],
        'App\Events\Activities\Posts\PostDeleted' => [
            'App\Listeners\Activities\Stream\DeleteActivity',
        ],
        'App\Events\Activities\Comments\CommentCreated' => [
            'App\Listeners\Activities\Stream\CreateActivity',
        ],
        'App\Events\Activities\Comments\CommentDeleted' => [
            'App\Listeners\Activities\Stream\DeleteActivity',
        ],
        'App\Events\Activities\Feeds\FeedFollowed' => [
            'App\Listeners\Activities\Stream\Feeds\FollowFeed',
        ],
        'App\Events\Activities\Feeds\FeedUnfollowed' => [
            'App\Listeners\Activities\Stream\Feeds\UnfollowFeed',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    }
}
