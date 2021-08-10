<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\EloquentCustomer;
use App\Models\EloquentCustomerPoint;
use App\Models\PointEvent;
use App\Services\AddPointService;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddPointServiceTest extends TestCase
{
    use RefreshDatabase;

    const CUSTOMER_ID = 1;

    protected function setUp(): void
    {
        parent::setUp();

        EloquentCustomer::factory()->create(
            [
                'id' => self::CUSTOMER_ID,
            ]
        );
        EloquentCustomerPoint::unguard();
        EloquentCustomerPoint::create(
            [
                'customer_id' => self::CUSTOMER_ID,
                'point' => 100,
            ]
        );
        EloquentCustomerPoint::reguard();
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function add()
    {
        $event = new PointEvent(
            self::CUSTOMER_ID,
            '加算イベント',
            10,
            CarbonImmutable::create(2018, 8, 4, 12, 34, 56)
        );
        /** @var AddPointService $service */
        $service = app()->make(AddPointService::class);
        $service->add($event);

        $this->assertDatabaseHas(
            'customer_point_events',
            [
                'customer_id' => self::CUSTOMER_ID,
                'event' => $event->getEvent(),
                'point' => $event->getPoint(),
                'created_at' => $event->getCreatedAt(),
            ]
        );
        $this->assertDatabaseHas(
            'customer_points',
            [
                'customer_id' => self::CUSTOMER_ID,
                'point' => 110,
            ]
        );
    }
}
