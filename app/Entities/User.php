<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullName', 'username', 'email', 'password', 'bio', 'birth', 'photo', 'cover'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Returns the social media connections the user have
     */
    public function socials()
    {
        return $this->hasMany(UserSocial::class);
    }

    /**
     * Returns all the posts the user created
     */
    public function posts()
    {
        return $this->hasMany(Post::class) ?? null;
    }

    public function getListPostsAttribute()
    {
        return $this->listPosts = $this->posts()->orderBy('created_at', 'desc')->get();
    }

    public function getCoverAttribute() {
        return $this->cover = $this->attributes['cover'] === null ? asset('img/default-cover.png') : $this->attributes['cover'];
    }

    /**
     * Sets a unique username to the user
     * @return string $username
     */
    public function generateUsername()
    {
        // $name = strtolower($this->attributes['fullName']) ?? 'user';
        // $explodedName = explode(' ', $name);
        // $username = $explodedName[0]; 
        // if(count($explodedName) === 2)
        // {
        //     $username = $username.'_'.$explodedName[1];
        // }
        // -------------------- IMPLEMENTACAO DE USER NAME BASEADO NO NOME ---------------------
        // Nao funciona direito caso haja caracteres acentuados/invalidos no nome do usuário

        $username = 'user';

        $i = 1;
        $temp = $username; // Temp eh uma variavel a ser analisada e incrementada pelo while sem afetar o $username
        while(User::where('username', $temp)->exists())
        {
            $temp = $username.$i;
            $i++;
        }

        $username = $username.$i;

        $this->attributes['username'] = $username;
        return $username;
    }

    /**
     * Sets a new password to the user
     */
    public function setNewPassword()
    {
        $this->attributes['password'] = env('PW_CRYPT') ? bcrypt(Str::random(10)) : Str::random(10);
        return $this->attributes['password'];
    }
}
