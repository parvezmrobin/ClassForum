<?php

namespace App\Notifications;

use App\Events\ThreadCreatedInChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ThreadCreatedInChannelNotification extends Notification
{
    use Queueable;
    public $event;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ThreadCreatedInChannel $event)
    {
        $this->event = $event;
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
            'notification' => 'New thread published in channel ' . $this->event->channel->channel,
            'url' => url('thread/' . $this->event->thread->id),
        ];
    }
}
