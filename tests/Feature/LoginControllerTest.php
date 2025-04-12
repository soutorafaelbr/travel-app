<?php

namespace Tests\Feature;

use App\Domain\Authentication\Exceptions\AuthenticationFailedException;
use App\Models\User;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    public function test_login_responds_with_http_ok(): void
    {
        $user = User::factory()->create();

        $this->withoutExceptionHandling()
            ->postJson(route('login'), ['email' => $user->email, 'password' => 'password'])
            ->assertOk();
    }

    public function test_authentication_failed_responds_with_unauthorized(): void
    {
        $user = User::factory()->create();

        $this->postJson(route('login'), ['email' => $user->email, 'password' => 'some-password'])
            ->assertUnauthorized();
    }

    public function test_authentication_failed_throws_exception(): void
    {
        $this->expectException(AuthenticationFailedException::class);

        $user = User::factory()->create();

        $this->withoutExceptionHandling()
            ->postJson(route('login'), ['email' => $user->email, 'password' => 'some-password']);
    }
}
