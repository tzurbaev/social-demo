<?php

namespace App;

use App\Contracts\Entities\AttachableContract;
use App\Contracts\Entities\CommentableContract;
use App\Traits\Comments\Comments;
use Illuminate\Database\Eloquent\Model;

class Video extends Model implements AttachableContract, CommentableContract
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

    /**
     * Commentable entity type.
     *
     * @return string
     */
    public function commentableType(): string
    {
        return 'image';
    }
}
