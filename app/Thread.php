<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property mixed description
 * @property int user_id
 * @property int channel_id
 * @property mixed title
 * @property mixed followedBy
 * @property mixed history
 * @property mixed user
 * @property mixed channel
 * @property mixed answers
 * @property mixed created_at
 * @property mixed updated_at
 */
class Thread extends Model
{
    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function followedBy()
    {
        return $this->morphToMany('App\User', 'followable');
    }

    public function favoriteBy()
    {
        return $this->belongsToMany('App\User', 'favorites');
    }

    public function viewedBy()
    {
        return $this->belongsToMany('App\User', 'views');
    }

    public function histories()
    {
        return $this->hasMany(EditHistory::class);
    }
}
