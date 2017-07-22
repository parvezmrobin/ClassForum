<?php

namespace App\Events;

use App\Channel;
use App\Thread;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ThreadCreatedInChannel implements ShouldQueue
{
    use Dispatchable, SerializesModels;
    public $channel;
    public $thread;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Channel $channel, Thread $thread)
    {
        $this->channel = $channel;
        $this->thread = $thread;
    }
}
