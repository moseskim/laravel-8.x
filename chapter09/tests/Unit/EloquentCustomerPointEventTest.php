<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\EloquentCustomer;
use App\Models\EloquentCustomerPointEvent;
use App\Models\PointEvent;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EloquentCustomerPointEventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function register()
    {
        $customerId = 1;
        EloquentCustomer::factory()->create(
            [
                'id' => $customerId,
            ]
        );

        $event = new PointEvent(
            $customerId,
            '추가 포인트',
            100,
            CarbonImmutable::create(2018, 8, 4, 12, 34, 56)
        );
        $sut = new EloquentCustomerPointEvent();
        $sut->register($event);

        $this->assertDatabaseHas(
            'customer_point_events',
            [
                'customer_id' => $customerId,
                'event' => $event->getEvent(),
                'point' => $event->getPoint(),
                'created_at' => $event->getCreatedAt(),
            ]
        );
    }
}
