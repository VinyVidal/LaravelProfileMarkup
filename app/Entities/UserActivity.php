<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserActivity extends Model
{
    use SoftDeletes;

    protected $table = 'user_profile_activity';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'model', 'model_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function entity() {
        return $this->belongsTo($this->model, 'model_id');
    }

    public function getPostAttribute() {
        if($this->model === Post::class) {
            return $this->entity;
        } else {
            return $this->entity->post;
        }
    }

    public function getDescriptionAttribute() {
        switch ($this->model) {
            case Post::class:
                return '<strong>' . $this->user->fullName . '</strong> publicou algo';
                break;
            case PostComment::class:
                return '<strong>' . $this->user->fullName . '</strong> comentou uma publicação';
                break;
            case PostLike::class:
                return '<strong>' . $this->user->fullName . '</strong> gostou de uma publicação';
                break;

            default:
                return '';
                break;
        }
    }
}
