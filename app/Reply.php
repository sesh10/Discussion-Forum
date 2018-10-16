<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    protected $table = 'replies';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function discussion()
    {
        return $this->belongsTo('App\Discussion','discussion_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    

}
