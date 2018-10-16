<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function discussions(){
      return $this->hasMany('App\Discussion');
    }

    public function replies(){
      return $this->hasMany('App\Reply');
    }
    public function likes(){
        return $this->hasMany('App\Like');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Group', 'user__groups');
    }
}
