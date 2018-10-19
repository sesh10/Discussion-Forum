<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivateReplies extends Model
{
    //
    protected $table = 'private_replies';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function private_discussion(){
        return $this->belongsTo('App\PrivateDiscussion');
    }
    
}
