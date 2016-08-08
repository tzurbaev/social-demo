<?php

namespace App\Contracts\Entities;

interface AttachesContract
{
    /**
     * Attaches entity.
     *
     * @param \App\Contracts\Entities\AttachableContract $entity
     */
    public function attach(AttachableContract $entity);
}
