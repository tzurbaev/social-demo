<?php

namespace App;

use App\Contracts\Activities\EntryContract;
use App\Contracts\Entities\AttachesContract;
use App\Contracts\Entities\CommentableContract;
use App\Traits\Attachments\Attachments;
use App\Traits\Attachments\ImageAttachments;
use App\Traits\Attachments\VideoAttachments;
use App\Traits\Comments\Comments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model implements EntryContract, AttachesContract, CommentableContract
{
    use Comments;
    use Attachments;
    use ImageAttachments;
    use VideoAttachments;

    const TYPE_POST = 'post';
    const TYPE_IMAGE = 'image';
    const TYPE_VIDEO = 'video';
    const TYPE_LINK = 'link';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['message'];

    /**
     * Post author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * "type" attribute accessor.
     *
     * @return string
     */
    public function getTypeAttribute(): string
    {
        $hasMessage = Str::length($this->message) > 0;

        if ($hasMessage) {
            return static::TYPE_POST;
        }

        $hasImages = $this->imagesCount() > 0;
        $hasVideos = $this->videosCount() > 0;

        $onlyImages = $hasImages && !$hasVideos;
        $onlyVideos = !$hasImages && $hasVideos;

        if ($onlyImages) {
            return static::TYPE_IMAGE;
        } elseif ($onlyVideos) {
            return static::TYPE_VIDEO;
        }

        return static::TYPE_POST;
    }

    /**
     * Commentable entity type.
     *
     * @return string
     */
    public function commentableType(): string
    {
        return 'post';
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
            'verb' => $this->type,
            'object' => 'post:'.$this->id,
        ];
    }
}
