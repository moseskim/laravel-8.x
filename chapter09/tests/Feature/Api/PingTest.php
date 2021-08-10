<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use Tests\TestCase;

class PingTest extends TestCase
{
    /**
     * @test
     */
    public function get_ping()
    {
        $response = $this->get('/api/ping');
        $response->assertStatus(200);
        $response->assertExactJson(['message' => 'pong']);
    }
}
