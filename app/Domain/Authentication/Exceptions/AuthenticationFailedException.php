<?php

namespace App\Domain\Authentication\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class AuthenticationFailedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Authentication failed', JsonResponse::HTTP_UNAUTHORIZED);
    }

    public function render(): JsonResponse
    {
        return response()->json(['message' => $this->getMessage()], $this->getCode());
    }
}
