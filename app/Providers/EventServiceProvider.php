<?php

namespace App\Providers;

use App\Events\ThreadAnswered;
use App\Events\ThreadCreated;
use App\Events\ThreadCreatedByUser;
use App\Events\ThreadCreatedInChannel;
use App\Listeners\ThreadAnsweredListener;
use App\Listeners\ThreadCreatedInChannelListener;
use App\Listeners\ThreadCreatedListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        ThreadAnswered::class => [
            ThreadAnsweredListener::class
        ],
        ThreadCreated::class => [
            ThreadCreatedListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
