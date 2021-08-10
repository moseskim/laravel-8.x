<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\PublishProcessor;

final class MessageSubscriber
{
    /**
     * @param  PublishProcessor  $event
     */
    public function handle(PublishProcessor $event): void
    {
        var_dump($event->getInt());
    }
}
