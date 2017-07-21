<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Store a newly created Answer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $answer = new Answer();
        $answer->answer = $request->answer;
        $answer->thread_id = $request->thread;
        $answer->user_id = \Auth::id();
        $answer->save();

        $answer->load('replies', 'user');

        return response()->json([
            "status" => "succeeded",
            "answer" => $answer
        ]);
    }

    /**
     * Remove the specified Answer from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return response()->json(["status" => "succeeded"]);
    }
}
