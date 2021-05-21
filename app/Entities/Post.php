<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['text', 'attachment', 'visibility', 'user_id'];

    protected $hidden = [];

    /**
     * Returns the post author user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(PostComment::class);
    }

    public function getTimeSinceCreatedAttribute()
    {
        $created = new Carbon($this->created_at);
        return $this->timeSinceCreated = $created->diffForHumans();
    }

    public static function feed(User $user) {
        return self::whereIn('user_id', array_merge([$user->id], $user->followeds->pluck('followed_id')->all()));
    }

    public static function activity(User $user) {
        return self::join('post_comments', 'posts.id', 'post_comments.post_id')->where('post_comments.user_id', $user->id)->where('post_comments.deleted_at', null)->orWhere('posts.user_id', $user->id)->select('posts.*')->orderBy('post_comments.created_at', 'desc')->orderBy('posts.created_at', 'desc')->distinct();
    }
}
