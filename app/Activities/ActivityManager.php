<?php

namespace App\Activities;

use App\Contracts\Activities\ActivityManagerContract;
use App\Contracts\Activities\ActorContract;
use App\Contracts\Activities\EntryContract;

class ActivityManager implements ActivityManagerContract
{
    /**
     * Creates new activity entry.
     *
     * @param \App\Contracts\Activities\ActorContract $author Activity author.
     * @param \App\Contracts\Activities\EntryContract $entry  Activity entry.
     */
    public function add(ActorContract $author, EntryContract $entry)
    {
    }
}
