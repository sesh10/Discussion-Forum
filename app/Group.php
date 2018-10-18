<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $table = 'groups';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function users()
     {
         return $this->belongsToMany('App\User', 'group_user');
     }

    public function private_discussions()
    {
        return $this->hasMany('App\PrivateDiscussion');
    }
}
