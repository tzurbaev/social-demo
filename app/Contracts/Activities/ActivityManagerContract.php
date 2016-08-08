<?php

namespace App\Contracts\Activities;

interface ActivityManagerContract
{
    /**
     * Creates new activity entry.
     *
     * @param \App\Contracts\Activities\ActorContract $author Activity author.
     * @param \App\Contracts\Activities\EntryContract $entry  Activity entry.
     */
    public function add(ActorContract $author, EntryContract $entry);
}
