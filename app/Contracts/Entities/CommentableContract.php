<?php

namespace App\Contracts\Entities;

interface CommentableContract
{
    /**
     * Comments relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function comments();

    /**
     * Comments count.
     *
     * @return int
     */
    public function commentsCount(): int;

    /**
     * Creates new commentary on entity.
     *
     * @param \App\Contracts\Entities\CommentContract $comment
     */
    public function discuss(CommentContract $comment);

    /**
     * Commentable entity type (post, image, video, etc.).
     *
     * @return string
     */
    public function commentableType(): string;
}
