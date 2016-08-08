<?php

namespace App\Traits\Comments;

use App\Comment;
use App\Contracts\Entities\CommentContract;

trait Comments
{
    /**
     * Comments relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function comments()
    {
        return $this->morphToMany(Comment::class, 'commentable');
    }

    /**
     * Comments count.
     *
     * @return int
     */
    public function commentsCount(): int
    {
        if ($this->relationLoaded('comments')) {
            return count($this->comments);
        }

        return $this->comments()->count();
    }

    /**
     * Creates new commentary on entity.
     *
     * @param \App\Contracts\Entities\CommentContract $comment
     */
    public function discuss(CommentContract $comment)
    {
        $this->comments()->attach($comment);
    }
}
