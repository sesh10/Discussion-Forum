<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivateDiscussion extends Model
{
    //
    protected $table = 'private_discussion';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function group(){
        return $this->belongsTo('App\Group');
    }

    public function private_replies(){
        return $this->hasMany('App\PrivateReplies');
    }
}
