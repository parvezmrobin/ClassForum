<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function threads()
    {
        return $this->hasMany('App\Thread');
    }

    public function followedBy()
    {
        return $this->morphToMany('App\User', 'followable');
    }
}
