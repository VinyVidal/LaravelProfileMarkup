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
}
