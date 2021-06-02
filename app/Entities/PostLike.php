<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $fillable = ['post_id', 'user_id'];

    protected $hidden = [];

    /**
     * Returns the post liked
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Returns the user who liked the post
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
