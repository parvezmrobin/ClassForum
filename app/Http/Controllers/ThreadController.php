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
    public function index(Request $request)
    {
        // Get the params
        $channel = $request->input('channel');

        // Set the conditions for query
        $conditions = [];
        if ($channel) {
            $conditions[] = ['channel_id', $channel];
        }

        // Perform the queries
        $threads = Thread::where($conditions)
            ->latest()
            ->paginate(10);

        $channels = Channel::all();
        $followedChannels = Auth::user()->followedChannels;

        //Check if the channel is followed by the user
        foreach ($channels as $channel) {
            $channelId = $channel->id;
            $check = $followedChannels->contains(function ($value) use ($channelId) {
                return $value->id == $channelId;
            });
            if ($check) {
                $channel->isFollowed = true;
            } else {
                $channel->isFollowed = false;
            }
        }

        // Return the view with data
        return view('home')->withThreads($threads)->withChannels($channels);
    }

    public function create()
    {
        return view('create')->withChannels(Channel::all());
    }

    public function store(Request $request)
    {
        $thread = new Thread();
        $thread->title = $request->title;
        $thread->description = $request->description;
        $thread->user_id = Auth::id();
        $thread->channel_id = $request->channel;
        $thread->save();

        return \Redirect::route('thread.show', ['thread' => $thread->id]);
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
                'otherThreads' => $otherThreads,
                'isFollowed' => !! $thread->followedBy()->where('user_id', Auth::id())->count(),
                'isFavorite' => !! $thread->favoriteBy()->where('user_id', Auth::id())->count(),
            ]);
    }

    /**
     * Follow a Thread
     * @param Thread $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function followThread(Thread $thread)
    {
        $thread->followedBy()->attach(Auth::id());
        return response()->json(["status" => "succeeded"]);
    }

    /**
     * Unfollow a Thread
     * @param Thread $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfollowThread(Thread $thread)
    {
        $thread->followedBy()->detach(Auth::id());
        return response()->json(["status" => "succeeded"]);
    }

    /**
     * Favorite a Thread
     * @param Thread $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function favoriteThread(Thread $thread)
    {
        $thread->favoriteBy()->attach(Auth::id());
        return response()->json(["status" => "succeeded"]);
    }

    /**
     * Unfavorite a Thread
     * @param Thread $thread
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfavoriteThread(Thread $thread)
    {
        $thread->favoriteBy()->detach(Auth::id());
        return response()->json(["status" => "succeeded"]);
    }
}