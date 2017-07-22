<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int user_id
 * @property int thread_id
 * @property mixed user
 * @property mixed thread
 * @property mixed answer
 * @property mixed replies
 * @property mixed created_at
 * @property mixed updated_at
 */
class Answer extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
}
