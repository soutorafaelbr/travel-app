<?php

namespace App\Domain\Authentication\Services;

use App\Models\User;

class LogoutService
{
    public function handle(User $user): void
    {
        $user->tokens()->delete();
    }
}
