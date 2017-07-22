<?php

namespace App\Listeners;

use App\Events\ThreadCreatedByUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThreadCreatedByUserListener
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
     * @param  ThreadCreatedByUser  $event
     * @return void
     */
    public function handle(ThreadCreatedByUser $event)
    {
        $users = $event->user->followedBy;

        \Notification::send($users, $event);
    }
}
