<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App
 * @property int id
 * @property mixed role
 * @property mixed users
 * @property mixed created_at
 * @property mixed updated_at
 */
class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
