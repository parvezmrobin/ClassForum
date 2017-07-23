<?php
/**
 * Created by PhpStorm.
 * User: alami
 * Date: 18-Jul-17
 * Time: 1:46 AM
 */

namespace App\Http\Controllers;


use App\Channel;
use App\Thread;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function store(Request $request)
    {
        $channel = new Channel();
        $channel->channel = $request->channel;
        $channel->save();

        return response()->json([
            "status" => "succeeded",
            "channel" => $channel,
        ]);
    }
    public function follow(Channel $channel)
    {
        $channel->followedBy()->attach(\Auth::id());
        return response()->json(["status" => "succeeded"]);
    }

    public function unfollow(Channel $channel)
    {
        $channel->followedBy()->detach(\Auth::id());
        return response()->json(["status" => "succeeded"]);
    }
}