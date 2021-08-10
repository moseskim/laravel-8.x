<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class WithoutMiddlewareTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * @test
     */
    public function 모든_미들웨어를_비활성화()
    {
        $response = $this->getJson('/api/live');

        $response->assertStatus(200);
    }
}
