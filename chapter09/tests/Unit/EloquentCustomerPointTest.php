<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\EloquentCustomer;
use App\Models\EloquentCustomerPoint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EloquentCustomerPointTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function addPoint()
    {
        $customerId = 1;
        EloquentCustomer::factory()->create(
            [
                'id' => $customerId,
            ]
        );

        EloquentCustomerPoint::unguard();
        EloquentCustomerPoint::create(
            [
                'customer_id' => $customerId,
                'point' => 100,
            ]
        );
        EloquentCustomerPoint::reguard();

        $eloquent = new EloquentCustomerPoint();
        $result = $eloquent->addPoint($customerId, 10);

        $this->assertTrue($result);
        $this->assertDatabaseHas(
            'customer_points',
            [
                'customer_id' => $customerId,
                'point' => 110,
            ]
        );
    }
}
