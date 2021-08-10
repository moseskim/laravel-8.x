<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use App\Models\EloquentCustomer;
use App\Models\EloquentCustomerPoint;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddPointTest extends TestCase
{
    use RefreshDatabase;

    const CUSTOMER_ID = 1;

    protected function setUp(): void
    {
        parent::setUp();

        CarbonImmutable::setTestNow();

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
     */
    public function put_add_point()
    {
        $response = $this->putJson(
            '/api/customers/add_point',
            [
                'customer_id' => self::CUSTOMER_ID,
                'add_point' => 10,
            ]
        );
        $response->assertStatus(200);

        $expected = ['customer_point' => 110];
        $response->assertExactJson($expected);

        $this->assertDatabaseHas(
            'customer_points',
            [
                'customer_id' => self::CUSTOMER_ID,
                'point' => 110,
            ]
        );
        $this->assertDatabaseHas(
            'customer_point_events',
            [
                'customer_id' => self::CUSTOMER_ID,
                'event' => 'ADD_POINT',
                'point' => 10,
                'created_at' => CarbonImmutable::now()->toDateTimeString(),
            ]
        );
    }

    /**
     * @test
     */
    public function put_add_point_밸리데이션_에러()
    {
        $response = $this->putJson(
            '/api/customers/add_point',
            [
            ]
        );

        $response->assertStatus(422);

        $expected = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'customer_id' => [
                    'The customer id field is required.',
                ],
                'add_point' => [
                    'The add point field is required.',
                ],
            ],
        ];
        $response->assertExactJson($expected);
    }

    /**
     * @test
     */
    public function put_add_point_밸리데이션_에러_erros만_검증()
    {
        $response = $this->putJson(
            '/api/customers/add_point',
            [
            ]
        );

        $response->assertStatus(422);

        $expected = [
            'errors' => [
                'customer_id' => [
                    'The customer id field is required.',
                ],
                'add_point' => [
                    'The add point field is required.',
                ],
            ],
        ];
        $response->assertJson($expected);
    }

    /**
     * @test
     */
    public function put_add_point_밸리데이션_에러_키만_검증()
    {
        $response = $this->putJson(
            '/api/customers/add_point',
            [
            ]
        );

        $response->assertStatus(422);

        $jsonValues = $response->json();
        $this->assertArrayHasKey('errors', $jsonValues);

        $errors = $jsonValues['errors'];
        $this->assertArrayHasKey('customer_id', $errors);
        $this->assertArrayHasKey('add_point', $errors);
    }

    /**
     * @test
     * @dataProvider dataProvider_put_add_point_add_point_사전_조건_에러
     */
    public function put_add_point_add_point_사전_조건_에러(int $addPoint)
    {
        $response = $this->putJson(
            '/api/customers/add_point',
            [
                'customer_id' => self::CUSTOMER_ID,
                'add_point' => $addPoint,
            ]
        );

        $response->assertStatus(400);
        $expected = [
            'message' => 'add_point should be equals or greater than 1',
        ];
        $response->assertExactJson($expected);
    }

    public function dataProvider_put_add_point_add_point_사전_조건_에러(): array
    {
        return [
            [0],
            [-1],
        ];
    }

    /**
     * @test
     */
    public function put_add_point_customer_id_사전_조건_에러()
    {
        $response = $this->putJson(
            '/api/customers/add_point',
            [
                'customer_id' => 999,
                'add_point' => 10,
            ]
        );

        $response->assertStatus(400);
        $expected = [
            'message' => 'customers.id:999 does not exists',
        ];
        $response->assertExactJson($expected);
    }
}
