<?php

namespace App\Notifications;

use App\Events\ThreadAnswered;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ThreadAnsweredNotification extends Notification
{
    use Queueable;
    public $threadAnswered;

    /**
     * Create a new notification instance.
     *
     * @param ThreadAnswered $threadAnswered
     */
    public function __construct(ThreadAnswered $threadAnswered)
    {
        $this->threadAnswered = $threadAnswered;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'notification' => "'{$this->threadAnswered->thread->title}' has a new answer.",
            'url' => url('thread/' . $this->threadAnswered->thread->id) . '#' . $this->threadAnswered->answer->id,
        ];
    }
}
