<?php

namespace App;

use App\Contracts\Entities\CommentContract;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model implements CommentContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['message', 'reply_to_comment_id'];

    /**
     * Comment author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Parent comment.
     *
     * @return \App\Contracts\Entities\CommentContract
     */
    public function replyTo()
    {
        return $this->belongsTo(self::class, 'reply_to_comment_id')->first();
    }
}
