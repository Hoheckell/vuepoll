<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public function poll(){
        return $this->hasOne(Poll::class,'poll_id','id');
    }
}
