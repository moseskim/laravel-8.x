<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function 미들웨어를_비활성화해서_actingAs로_인증_사용자_설정()
    {
        $user = User::factory()->create(
            [
                'name' => 'Mike',
            ]
        );
        assert($user instanceof Authenticatable);

        $response = $this->withoutMiddleware()
            ->actingAs($user)
            ->getJson('/api/user');

        $response->assertStatus(200);
        $response->assertJson(
            [
                'name' => 'Mike',
            ]
        );
    }

    /**
     * @test
     */
    public function 미들웨어를_비활성화하지_않고_actingAs로_인증_사용자_설정()
    {
        $user = User::factory()->create(
            [
                'name' => 'Mike',
            ]
        );
        assert($user instanceof Authenticatable);

        $response = $this->actingAs($user)
            ->getJson('/api/user');

        $response->assertStatus(401);
    }


    /**
     * @test
     */
    public function sanctum_actingAs()
    {
        $user = User::factory()->create(
            [
                'name' => 'Mike',
            ]
        );
        assert($user instanceof Authenticatable);

        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/sanctum-user');

        $response->assertStatus(200);
        $response->assertJson(
            [
                'name' => 'Mike',
            ]
        );
    }
}
