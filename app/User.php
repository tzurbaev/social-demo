<?php

namespace App;

use App\Contracts\Activities\ActorContract;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements ActorContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'gender',
        'birth_date', 'city_id', 'website',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * "full_name" attribute accessor.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name.' '.$this->last_name);
    }

    /**
     * "city_name" attribute accessor.
     *
     * @return string
     */
    public function getCityNameAttribute(): string
    {
        return $this->city->name;
    }

    /**
     * City relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo | \App\City
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
