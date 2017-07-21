<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Store a newly created Reply in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reply = new Reply();
        $reply->reply = $request->reply;
        $reply->answer_id = $request->answer;
        $reply->user_id = \Auth::id();
        $reply->save();

        $reply->load('answer', 'user');

        return response()->json([
            "status" => "succeeded",
            "reply" => $reply
        ]);
    }

    /**
     * Remove the specified Reply from storage.
     *
     * @param  \App\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $reply->delete();

        return response()->json(["status" => "succeeded"]);
    }
}
