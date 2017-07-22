<?php

namespace App\Events;

use App\Thread;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ThreadCreatedByUser implements ShouldQueue
{
    use Dispatchable, SerializesModels;
    public $user;
    public $thread;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Thread $thread)
    {
        $this->thread = $thread;
        $this->user = $user;
    }
}
