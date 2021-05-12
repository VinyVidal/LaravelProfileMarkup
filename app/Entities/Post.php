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

    public function getTimeSinceCreatedAttribute()
    {
        $created = new Carbon($this->created_at);
        return $this->timeSinceCreated = $created->diffForHumans();
    }

    public static function feed(User $user) {
        return self::whereIn('user_id', array_merge([$user->id], $user->followeds->pluck('followed_id')->all()))->orderBy('created_at', 'desc');
    }

    public static function activity(User $user) {
        return self::where('user_id', $user->id)->orderBy('created_at', 'desc');
    }
}
