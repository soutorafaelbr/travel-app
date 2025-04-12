<?php
namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LogoutControllerTest extends TestCase
{
    public function test_logout_responds_with_http_ok(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum')
            ->postJson(route('logout'))
            ->assertOk();
    }
}
