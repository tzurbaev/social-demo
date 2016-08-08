<?php

namespace App\Contracts\Activities;

interface EntryContract
{
    /**
     * Returns activity data (required for Activity Feed generation).
     *
     * @return array
     */
    public function activityData(): array;
}
