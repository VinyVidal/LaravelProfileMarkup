<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserSocial extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'social_network',
        'social_id',
        'social_email',
        'social_name',
        'social_nickname',
        'social_avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'social_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}