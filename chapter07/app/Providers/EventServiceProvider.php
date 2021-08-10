<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\PublishProcessor;
use App\Events\ReviewRegistered;
use App\Listeners\MessageSubscriber;
use App\Listeners\ReviewIndexCreator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PublishProcessor::class => [
            MessageSubscriber::class
        ],
        ReviewRegistered::class => [
            ReviewIndexCreator::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        //
        // Event::listen();
    }
}
