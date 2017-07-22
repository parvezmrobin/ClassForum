<?php

namespace App\Events;

use App\Answer;
use App\Thread;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ThreadAnswered implements ShouldQueue
{
    use Dispatchable, SerializesModels;
    public $thread;
    public $answer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Thread $thread, Answer $answer)
    {
        $this->thread = $thread;
        $this->answer = $answer;
    }
}
