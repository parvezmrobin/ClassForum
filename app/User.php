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
 * @property mixed followedChannels
 * @property mixed followedThreads
 * @property mixed followedUsers
 * @property mixed threads
 * @property mixed answers
 * @property mixed replies
 * @property mixed roles
 * @property mixed favorites
 * @property mixed viewedThreads
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
        return $this->morphToMany(User::class, 'followable');
    }

    public function followedThreads()
    {
        return $this->morphedByMany(Thread::class, 'followable');
    }

    public function followedUsers()
    {
        return $this->morphedByMany(User::class, 'followable');
    }

    public function followedChannels()
    {
        return $this->morphedByMany(Channel::class, 'followable');
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Thread::class, 'favorites');
    }

    public function viewedThreads()
    {
        return $this->belongsToMany(Thread::class, 'views');
    }
}
