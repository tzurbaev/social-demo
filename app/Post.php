<?php

namespace App;

use App\Contracts\Entities\AttachableContract;
use App\Contracts\Entities\AttachesContract;
use App\Traits\Attachments\ImageAttachments;
use App\Traits\Attachments\VideoAttachments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model implements AttachesContract
{
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
     * Attaches entity.
     *
     * @param \App\Contracts\Entities\AttachableContract $entity
     */
    public function attach(AttachableContract $entity)
    {
        if ($entity instanceof Image) {
            return $this->attachImage($entity);
        } elseif ($entity instanceof Video) {
            return $this->attachVideo($entity);
        }
    }
}
