<?php

namespace App\Listeners;

use App\Events\ThreadAnswered;
use App\Notifications\ThreadAnsweredNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThreadAnsweredListener
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
     * @param  ThreadAnswered  $event
     * @return void
     */
    public function handle(ThreadAnswered $event)
    {
        $users = $event->thread->followedBy;
        \Notification::send($users, new ThreadAnsweredNotification($event));
    }
}
