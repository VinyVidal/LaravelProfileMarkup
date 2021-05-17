<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostComment extends Model
{
    use SoftDeletes;

    protected $fillable = ['comment', 'post_id', 'user_id'];

    protected $hidden = [];

    /**
     * Returns the post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Returns the comment author user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTimeSinceCreatedAttribute()
    {
        $created = new Carbon($this->created_at);
        return $this->timeSinceCreated = $created->diffForHumans();
    }
}
