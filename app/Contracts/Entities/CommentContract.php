<?php

namespace App\Contracts\Entities;

interface CommentContract
{
    /**
     * Comment author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author();

    /**
     * Parent comment.
     *
     * @return \App\Contracts\Entities\CommentContract
     */
    public function replyTo();
}
