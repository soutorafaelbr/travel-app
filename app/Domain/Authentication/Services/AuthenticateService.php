<?php

namespace App\Domain\Authentication\Services;

use App\Domain\Authentication\Exceptions\AuthenticationFailedException;
use App\Domain\Authentication\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthenticateService
{
    public function __construct(private readonly UserRepository $repository) {}

    public function handle($email, $password): string
    {
        $user = $this->repository->findByEmailOrFail($email);

        throw_unless(Hash::check($password, $user->password), AuthenticationFailedException::class);

        return $user->createToken('api-token')->plainTextToken;
    }
}
