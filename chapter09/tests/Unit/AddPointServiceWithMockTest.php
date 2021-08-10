<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\EloquentCustomerPoint;
use App\Models\EloquentCustomerPointEvent;
use App\Models\PointEvent;
use App\Services\AddPointService;
use Carbon\CarbonImmutable;
use Tests\TestCase;

class AddPointServiceWithMockTest extends TestCase
{
    private $customerPointEvent;
    private $customerPoint;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customerPointEvent = new class extends EloquentCustomerPointEvent {
            /** @var PointEvent */
            public $pointEvent;

            public function register(PointEvent $event)
            {
                $this->pointEvent = $event;
            }
        };

        $this->customerPoint = new class extends EloquentCustomerPoint {
            /** @var int */
            public $customerId;
            /** @var int */
            public $point;

            public function addPoint(int $customerId, int $point): bool
            {
                $this->customerId = $customerId;
                $this->point = $point;
                return true;
            }
        };
    }

    /**
     * @test
     */
    public function add()
    {
        $customerId = 1;
        $event = new PointEvent(
            $customerId,
            '加算イベント',
            10,
            CarbonImmutable::create(2018, 8, 4, 12, 34, 56)
        );

        $service = new AddPointService(
            $this->customerPointEvent,
            $this->customerPoint
        );
        $service->add($event);

        $this->assertEquals($event, $this->customerPointEvent->pointEvent);
        $this->assertSame($customerId, $this->customerPoint->customerId);
        $this->assertSame(10, $this->customerPoint->point);
    }
}
