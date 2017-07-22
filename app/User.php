<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property mixed name
 * @property mixed followedBy
 * @property mixed email
 * @property mixed bio
 * @property mixed image
 * @property mixed sex
 * @property bool is_approved
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'bio', 'image', 'sex', 'is_approved'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function followedBy()
    {
        return $this->morphToMany('App\User', 'followable');
    }

    public function followedThreads()
    {
        return $this->morphedByMany('App\Thread', 'followable');
    }

    public function followedUsers()
    {
        return $this->morphedByMany('App\User', 'followable');
    }

    public function followedChannels()
    {
        return $this->morphedByMany('App\Channel', 'followable');
    }

    public function threads()
    {
        return $this->hasMany('App\Thread');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function favorites()
    {
        return $this->belongsToMany('App\Thread', 'favorites');
    }

    public function viewedThreads()
    {
        return $this->belongsToMany('App\Thread', 'views');
    }
}
