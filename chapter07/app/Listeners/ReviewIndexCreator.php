<?php
declare(strict_types=1);

namespace App\Listeners;

use App\DataProvider\Elasticsearch\AddReviewIndexDataProvider;
use App\Events\ReviewRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReviewIndexCreator implements ShouldQueue
{
    use InteractsWithQueue;

    private $provider;

    public function __construct(
        AddReviewIndexDataProvider $provider
    ) {
        $this->provider = $provider;
    }

    public function handle(ReviewRegistered $event)
    {
        $this->provider->add(
            $event->getId(),
            $event->getTitle(),
            $event->getContent(),
            $event->getCreatedAtEpoch(),
            $event->getTags(),
            $event->getUserId()
        );
    }
}
