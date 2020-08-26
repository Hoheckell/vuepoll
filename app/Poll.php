<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    public function options(){
        return $this->hasMany(Option::class,'poll_id','id');
    }
}
