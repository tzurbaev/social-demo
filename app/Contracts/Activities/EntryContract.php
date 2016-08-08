<?php

namespace App\Contracts\Activities;

interface EntryContract
{
    /**
     * Entry author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author();

    /**
     * Returns activity data (required for Activity Feed generation).
     *
     * @return array
     */
    public function activityData(): array;
}
