<?php

namespace App\Http\Controllers;

use App\Channel;
use Auth;
use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Shows the home page
     * @param Request $request
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function index(Request $request, User $user)
    {
        // Get the params
        $page = $request->input('page');
        $channel = $request->input('channel');

        // Set the conditions for query
        $conditions = [];
        if ($channel) {
            $conditions[] = ['channel_id', $channel];
        }
        if (is_null($page)) {
            $page = 0;
        }

        // Perform the queries
        $threads = Thread::where($conditions)
            ->latest()
            ->paginate(10);

        $channels = Channel::all();
        $followedChannels = $user->followedChannels;

        //Check if the channel is followed by the user
        foreach ($channels as $channel) {
            if ($followedChannels->contains($channel)) {
                $channel->isFollowed = true;
            } else {
                $channel->isFollowed = false;
            }
        }

        // Return the view with data
        return view('home')->withThreads($threads)->withChannels($channels);
    }

    /**
     * Shows a Thread
     * @param int $thread id of a thread
     * @return \Illuminate\View\View
     */
    public function show($thread)
    {
        // Get the thread
        $thread = Thread::withCount('viewedBy')
            ->withCount('followedBy')
            ->withCount('favoriteBy')
            ->with('answers.user')
            ->with('answers.replies.user')
            ->where('id', $thread)
            ->get()[0];

        // Attach the user as a viewer
        $thread->viewedBy()->attach(Auth::id());

        // Get latest Threads of same channel
        $otherThreads = $thread->channel->threads()
            ->select(['id', 'title', 'user_id'])
            ->latest()->take(10)->get();

        // Return the view with related data
        return view('thread')
            ->with([
                'thread' => $thread,
                'otherThreads' => $otherThreads
            ]);
    }

    /**
     * Follow a Thread
     * @param Thread $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function followThread(Thread $thread)
    {
        $thread->followedBy()->attach($thread->id);
        return response()->json(["status" => "succeeded"]);
    }

    /**
     * Unfollow a Thread
     * @param Thread $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfollowThread(Thread $thread)
    {
        $thread->followedBy()->detach($thread->id);
        return response()->json(["status" => "succeeded"]);
    }

    /**
     * Favorite a Thread
     * @param Thread $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function favoriteThread(Thread $thread)
    {
        $thread->favoriteBy()->attach($thread->id);
        return response()->json(["status" => "succeeded"]);
    }

    /**
     * Unfavorite a Thread
     * @param Thread $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfavoriteThread(Thread $thread)
    {
        $thread->favoriteBy()->detach($thread->id);
        return response()->json(["status" => "succeeded"]);
    }
}