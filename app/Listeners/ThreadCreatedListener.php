<?php

namespace App\Listeners;

use App\Events\ThreadCreated;
use App\Notifications\ThreadCreatedByUserNotification;
use App\Notifications\ThreadCreatedInChannelNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThreadCreatedListener
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
     * @param  ThreadCreated  $event
     * @return void
     */
    public function handle(ThreadCreated $event)
    {
        $users = $event->thread->followedBy;
        $channel = $event->thread->followedBy;
        Notification::send($users, new ThreadCreatedByUserNotification($event));
        Notification::send($channel, new ThreadCreatedInChannelNotification($event));
    }
}
