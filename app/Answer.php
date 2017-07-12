<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User');
    }
    public function threads()
    {
        return $this->belongsTo('App\Thread');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
}
