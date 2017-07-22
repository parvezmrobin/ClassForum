<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reply
 * @package App
 * @property int id
 * @property int user_id
 * @property int answer_id
 * @property mixed user
 * @property mixed answer
 * @property mixed reply
 * @property mixed created_at
 * @property mixed updated_at
 */
class Reply extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function answer()
    {
        return $this->belongsTo('App\Answer');
    }
}
