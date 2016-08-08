<?php

namespace App;

use App\Contracts\Activities\EntryContract;
use App\Contracts\Entities\AttachesContract;
use App\Contracts\Entities\CommentContract;
use App\Traits\Attachments\Attachments;
use App\Traits\Attachments\ImageAttachments;
use App\Traits\Attachments\VideoAttachments;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model implements EntryContract, CommentContract, AttachesContract
{
    use Attachments;
    use ImageAttachments;
    use VideoAttachments;

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
     * Polymorphic comment relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
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

    /**
     * Returns activity data (required for Activity Feed generation).
     *
     * @return array
     */
    public function activityData(): array
    {
        return [
            'actor' => 'user:'.$this->author_id,
            'verb' => 'comment',
            'object' => $this->commentable->commentableType().':'.$this->commentable->id,
        ];
    }
}
