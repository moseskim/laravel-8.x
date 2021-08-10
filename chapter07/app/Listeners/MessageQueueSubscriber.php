<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\PublishProcessor;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageQueueSubscriber implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(PublishProcessor $event)
    {
        \Log::info($event->getInt());
    }
}
