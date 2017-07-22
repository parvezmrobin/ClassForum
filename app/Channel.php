<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed channel
 * @property int id
 * @property mixed followedBy
 * @property mixed threads
 * @property int thread_id
 * @property mixed followedBy
 * @property mixed created_at
 * @property mixed updated_at
 */
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
