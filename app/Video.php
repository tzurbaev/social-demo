<?php

namespace App;

use App\Contracts\Entities\AttachableContract;
use App\Traits\Comments\Comments;
use Illuminate\Database\Eloquent\Model;

class Video extends Model implements AttachableContract
{
    use Comments;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'provider',
        'external_id', 'url', 'cover_url',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta_data' => 'array',
    ];
}
