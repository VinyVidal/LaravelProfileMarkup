<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Chat extends Model
{
    use SoftDeletes;

    protected $table = 'chat';

    protected $fillable = ['message', 'sender_id', 'receiver_id'];

    protected $hidden = [];

    /**
     * Returns the chat message sender
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Returns the chat message receiver
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function getTimeSinceCreatedAttribute()
    {
        $created = new Carbon($this->created_at);
        return $this->timeSinceCreated = $created->diffForHumans();
    }
}
