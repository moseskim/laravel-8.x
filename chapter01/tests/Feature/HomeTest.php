<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function testStatusCode()
    {
        $response = $this->get('/home');
        $response->assertStatus(200);
    }

    public function testBody()
    {
        $response = $this->get('/home');
        $response->assertSeeText("안녕하세요!");
    }
}
