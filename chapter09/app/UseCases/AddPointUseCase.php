<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Exceptions\PreconditionException;
use App\Models\EloquentCustomer;
use App\Models\EloquentCustomerPoint;
use App\Models\PointEvent;
use App\Services\AddPointService;
use Carbon\CarbonImmutable;
use Throwable;

final class AddPointUseCase
{
    /** @var AddPointService */
    private $service;
    /** @var EloquentCustomer */
    private $eloquentCustomer;
    /** @var EloquentCustomerPoint */
    private $eloquentCustomerPoint;

    public function __construct(
        AddPointService $service,
        EloquentCustomer $eloquentCustomer,
        EloquentCustomerPoint $eloquentCustomerPoint
    ) {
        $this->service = $service;
        $this->eloquentCustomer = $eloquentCustomer;
        $this->eloquentCustomerPoint = $eloquentCustomerPoint;
    }

    /**
     * @throws Throwable
     */
    public function run(
        int $customerId,
        int $addPoint,
        string $pointEvent,
        CarbonImmutable $now
    ): int {
        if ($addPoint <= 0) {
            throw new PreconditionException(

                'add_point should be equals or greater than 1'
            );
        }
        if (!$this->eloquentCustomer->where('id', $customerId)->exists()) {
            $message = sprintf('customers.id:%d does not exists', $customerId);
            throw new PreconditionException($message);
        }
        if (!$this->eloquentCustomerPoint->where('customer_id', $customerId)->exists()) {
            $message = sprintf(
                'customer_points.customer_id:%d does not exists',
                $customerId
            );
            throw new PreconditionException($message);
        }

        $event = new PointEvent($customerId, $pointEvent, $addPoint, $now);
        $this->service->add($event);

        return $this->eloquentCustomerPoint->findPoint($customerId);
    }
}
