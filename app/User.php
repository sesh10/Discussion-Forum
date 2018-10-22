<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Group_User;

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
    public function groups()
    {
        return $this->belongsToMany('App\Group','group_user');
    }
    // public function availableUsers()
    // for debugging
    // {
    //     // $ids = Group_User::where('user_id', '=', $this->id)->pluck('user_id');
    //     // return User::whereNotIn('id', $ids)->get();
    //
    //     $ids = Group_User::where('user_id', '=', $this->id)->pluck('user_id');
    //     return User::whereNotIn('id', $ids);
    // }
    public function private_discussions(){
      return $this->hasMany('App\PrivateDiscussion');
    }
    public function private_replies(){
        return $this->hasMany('App\PrivateReplies');
    }

}
