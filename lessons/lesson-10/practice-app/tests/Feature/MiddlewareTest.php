<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test CheckAge middleware blocks minors.
     */
    public function test_check_age_middleware_blocks_minors(): void
    {
        $response = $this->get('/adults-only?age=16');

        $response->assertRedirect('/');
        $response->assertSessionHas('error');
    }

    /**
     * Test CheckAge middleware allows adults.
     */
    public function test_check_age_middleware_allows_adults(): void
    {
        $response = $this->get('/adults-only?age=21');

        $response->assertOk();
    }

    /**
     * Test API key middleware requires key.
     */
    public function test_api_key_middleware_requires_key(): void
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(401);
        $response->assertJson(['error' => 'API key is required']);
    }

    /**
     * Test API key middleware accepts valid key.
     */
    public function test_api_key_middleware_accepts_valid_key(): void
    {
        $response = $this->withHeaders([
            'X-API-Key' => 'test-key-123',
        ])->getJson('/api/users');

        $response->assertOk();
        $response->assertJsonStructure(['message', 'users']);
    }

    /**
     * Test API key middleware rejects invalid key.
     */
    public function test_api_key_middleware_rejects_invalid_key(): void
    {
        $response = $this->withHeaders([
            'X-API-Key' => 'invalid-key',
        ])->getJson('/api/users');

        $response->assertStatus(401);
        $response->assertJson(['error' => 'Invalid API key']);
    }

    /**
     * Test role middleware blocks unauthorized users.
     */
    public function test_role_middleware_blocks_unauthorized_users(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    /**
     * Test role middleware allows authorized users.
     */
    public function test_role_middleware_allows_authorized_users(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertOk();
    }

    /**
     * Test role middleware allows multiple roles.
     */
    public function test_role_middleware_allows_multiple_roles(): void
    {
        $moderator = User::factory()->create(['role' => 'moderator']);
        $admin = User::factory()->create(['role' => 'admin']);

        // Moderator should be able to access
        $response = $this->actingAs($moderator)->get('/moderate');
        $response->assertOk();

        // Admin should also be able to access
        $response = $this->actingAs($admin)->get('/moderate');
        $response->assertOk();
    }

    /**
     * Test localization middleware sets locale from URL.
     */
    public function test_localization_middleware_sets_locale_from_url(): void
    {
        $response = $this->get('/welcome?lang=ar');

        $response->assertOk();
        $this->assertEquals('ar', app()->getLocale());
    }

    /**
     * Test rate limiting middleware blocks excessive requests.
     */
    public function test_rate_limiting_middleware_blocks_excessive_requests(): void
    {
        // Make 10 requests (should succeed)
        for ($i = 0; $i < 10; $i++) {
            $response = $this->get('/test-rate-limit');
            $response->assertOk();
        }

        // 11th request should be blocked
        $response = $this->get('/test-rate-limit');
        $response->assertStatus(429);
    }
}
