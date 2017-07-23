<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $isFollower = $user->followedBy()->wherePivot('user_id', Auth::id())->count();
        return view('profile')->withUser($user)->withIsFollower($isFollower);
    }
}
