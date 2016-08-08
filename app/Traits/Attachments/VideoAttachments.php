<?php

namespace App\Traits\Attachments;

use App\Contracts\Entities\AttachableContract;
use App\Video;

trait VideoAttachments
{
    /**
     * Attached videos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function videos()
    {
        return $this->morphToMany(Video::class, 'videoable');
    }

    /**
     * Attached videos count.
     *
     * @return int
     */
    public function videosCount(): int
    {
        if ($this->relationLoaded('videos')) {
            return count($this->videos);
        }

        return $this->videos()->count();
    }

    /**
     * Attaches video.
     *
     * @param \App\Contracts\Entities\AttachableContract $video
     */
    public function attachVideo(AttachableContract $video)
    {
        $this->videos()->attach($video);
    }
}
