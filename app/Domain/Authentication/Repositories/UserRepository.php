<?php

namespace App\Domain\Authentication\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct(private readonly User $model) {}

    public function findByEmailOrFail(string $email): User
    {
        return $this->model->where('email', $email)->firstOrFail();
    }
}
