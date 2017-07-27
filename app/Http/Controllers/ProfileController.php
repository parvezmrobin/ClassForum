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
        return view('profile')
            ->with([
                'user' => $user,
                'isFollower' => $isFollower
            ]);
    }

    public function follow(User $user)
    {
        if ($user->id == Auth::id()) {
            return response()->json(["status" => "One cannot follow self"]);
        }

        $user->followedBy()->attach(Auth::id());
        return response()->json(["status" => "succeeded"]);
    }

    public function unfollow(User $user)
    {
        $user->followedBy()->detach(Auth::id());
        return response()->json(["status" => "succeeded"]);
    }
}
