<?php

namespace App\Listeners;

use App\Events\ThreadCreatedInChannel;
use App\Notifications\ThreadCreatedInChannelNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThreadCreatedInChannelListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ThreadCreatedInChannel  $event
     * @return void
     */
    public function handle(ThreadCreatedInChannel $event)
    {
        $users = $event->channel->followedBy;

        \Notification::send($users, new ThreadCreatedInChannelNotification($event));
    }
}
