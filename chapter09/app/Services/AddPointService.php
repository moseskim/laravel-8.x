<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\EloquentCustomerPoint;
use App\Models\EloquentCustomerPointEvent;
use App\Models\PointEvent;
use Illuminate\Database\ConnectionInterface;
use Throwable;

final class AddPointService
{
    /** @var EloquentCustomerPointEvent */
    private $eloquentCustomerPointEvent;
    /** @var EloquentCustomerPoint */
    private $eloquentCustomerPoint;
    /** @var ConnectionInterface */
    private $db;

    /**
     * @param EloquentCustomerPointEvent $eloquentCustomerPointEvent
     * @param EloquentCustomerPoint $eloquentCustomerPoint
     */
    public function __construct(
        EloquentCustomerPointEvent $eloquentCustomerPointEvent,
        EloquentCustomerPoint $eloquentCustomerPoint
    ) {
        $this->eloquentCustomerPointEvent = $eloquentCustomerPointEvent;
        $this->eloquentCustomerPoint = $eloquentCustomerPoint;
        $this->db = $eloquentCustomerPointEvent->getConnection();
    }

    /**
     * @param PointEvent $event
     * @throws Throwable
     */
    public function add(PointEvent $event)
    {
        $this->db->transaction(
            function () use ($event) {
                $this->eloquentCustomerPointEvent->register($event);
                $this->eloquentCustomerPoint->addPoint(
                    $event->getCustomerId(),
                    $event->getPoint()
                );
            }
        );
    }
}
