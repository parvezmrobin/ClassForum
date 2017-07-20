<?php

namespace App\Http\Controllers;

use App\Channel;
use app\Filters\ThreadFilters;
use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index(Request $request, User $user)
    {
        $page = $request->input('page');
        $channel = $request->input('channel');
        $conditions = [];
        if ($channel) {
            $conditions[] = ['channel_id', $channel];
        }
        if (is_null($page)) {
            $page = 0;
        }
        $threads = Thread::where($conditions)
            ->latest()
            ->paginate(10);

        $channels = Channel::all();
        $followedChannels = $user->followedChannels;

        foreach ($channels as $channel) {
            if ($followedChannels->contains($channel)) {
                $channel->isFollowed = true;
            } else {
                $channel->isFollowed = false;
            }
        }

        return view('home')->withThreads($threads)->withChannels($channels);
    }

    public function show(Thread $thread)
    {
        $otherThreads = $thread->channel->threads()->latest()->take(10)->get();

        return view('thread')
            ->with([
                'thread' => $thread,
                'otherThreads' => $otherThreads
            ]);
    }
}