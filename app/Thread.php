<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 * @property string description
 * @property int user_id
 * @property int channel_id
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
}
