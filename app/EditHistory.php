<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditHistory extends Model
{
    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }
}
