<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EditHistory
 * @package App
 * @property int id
 * @property int thread_id
 * @property mixed thread
 * @property mixed title
 * @property mixed description
 * @property mixed created_at
 * @property mixed updated_at
 */
class EditHistory extends Model
{
    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }
}
