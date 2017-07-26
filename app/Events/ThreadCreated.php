<?php

namespace App\Events;

use App\Channel;
use App\Thread;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ThreadCreated implements ShouldQueue
{
    use Dispatchable, SerializesModels;
    public $user;
    public $thread;
    public $channel;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Thread $thread, Channel $channel)
    {
        $this->thread = $thread;
        $this->user = $user;
        $this->channel = $channel;
    }
}
