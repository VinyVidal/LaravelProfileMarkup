<?php

namespace App\Entities;

use App\Constants\PostVisibilityConstant;
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

    public function getVisibilityTextAttribute()
    {
        return PostVisibilityConstant::getOption($this->visibility);
    }

    public static function feed(User $user) {
        return self::whereIn('user_id', array_merge([$user->id], $user->followeds->pluck('followed_id')->all()))
        ->whereIn('visibility', [PostVisibilityConstant::VISIBLE_PUBLIC, PostVisibilityConstant::FOLLOWERS_ONLY])
        ->orderBy('created_at', 'desc');
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

    /**
     * Returns TRUE in case this Entity is current visible to the parameter user
     * 
     */
    public function visible(User $user)
    {
        switch($this->visibility) {
            case PostVisibilityConstant::VISIBLE_PUBLIC:
                return true;
                break;
            case PostVisibilityConstant::FOLLOWERS_ONLY:
                return $this->user->id === $user->id || $user->followsUser($this->user);
                break;
            case PostVisibilityConstant::SELF_ONLY:
                return $this->user->id === $user->id;
                break;
            default:
                return false;
                break;
        }
    }
}
