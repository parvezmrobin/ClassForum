<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed channel
 * @property int id
 * @property mixed followedBy
 * @property mixed threads
 * @property int thread_id
 * @property mixed created_at
 * @property mixed updated_at
 */
class Channel extends Model
{
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function followedBy()
    {
        return $this->morphToMany(User::class, 'followable');
    }
}
