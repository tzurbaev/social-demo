<?php

namespace App;

use App\Contracts\Entities\AttachableContract;
use Illuminate\Database\Eloquent\Model;

class Image extends Model implements AttachableContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'original_filename', 'parent_hash', 'child_hash',
        'filename', 'extension', 'meta_data',
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
