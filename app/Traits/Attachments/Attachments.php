<?php

namespace App\Traits\Attachments;

use App\Contracts\Entities\AttachableContract;
use App\Exceptions\Attachments\InvalidAttachmentType;
use App\Image;
use App\Video;

trait Attachments
{
    /**
     * Attaches entity.
     *
     * @param \App\Contracts\Entities\AttachableContract $entity
     *
     * @throws \App\Exceptions\Attachments\InvalidAttachmentType
     */
    public function attach(AttachableContract $entity)
    {
        $uses = array_flip(class_uses_recursive(static::class));

        if ($entity instanceof Image) {
            if (!isset($uses[ImageAttachments::class])) {
                throw new InvalidAttachmentType('[Image] can not be attached to this entity.');
            }

            return $this->attachImage($entity);
        } elseif ($entity instanceof Video) {
            if (!isset($uses[VideoAttachments::class])) {
                throw new InvalidAttachmentType('[Video] can not be attached to this entity.');
            }

            return $this->attachVideo($entity);
        }
    }
}
