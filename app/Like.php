<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    public function user(){
      return $this->belongsTo('App\User');
    }
    public function discussion(){
      return $this->belongsTo('App\Discussion');
    }
}
