<?php

namespace App\Traits\Attachments;

use App\Contracts\Entities\AttachableContract;
use App\Image;

trait ImageAttachments
{
    /**
     * Attached images.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

    /**
     * Attached images count.
     *
     * @return int
     */
    public function imagesCount(): int
    {
        if ($this->relationLoaded('images')) {
            return count($this->images);
        }

        return $this->images()->count();
    }

    /**
     * Attaches image.
     *
     * @param \App\Contracts\Entities\AttachableContract $image
     */
    public function attachImage(AttachableContract $image)
    {
        $this->images()->attach($image);
    }
}
