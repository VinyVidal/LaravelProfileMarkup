<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

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

    public function likes() {
        return $this->hasMany(PostLike::class);
    }

    public function getTimeSinceCreatedAttribute()
    {
        $created = new Carbon($this->created_at);
        return $this->timeSinceCreated = $created->diffForHumans();
    }

    public static function feed(User $user) {
        return self::whereIn('user_id', array_merge([$user->id], $user->followeds->pluck('followed_id')->all()))->orderBy('created_at', 'desc');
    }

    public static function activity(User $user) {
        $query = self::leftJoin('post_comments', 'posts.id', 'post_comments.post_id')
            ->where(function($qr) use ($user) {
                $qr->where('post_comments.user_id', $user->id)
                    ->where('post_comments.deleted_at', null);
            })
            ->orWhere(function($qr) use ($user) {
                $qr->where('posts.user_id', $user->id);
            })->select('posts.*')->orderBy('created_at', 'desc')->distinct();
        return $query;
    }
}
