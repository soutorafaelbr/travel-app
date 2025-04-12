<?php

namespace App\Http\Controllers\Authentication;

use App\Domain\Authentication\Services\AuthenticateService;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request, AuthenticateService $service): JsonResponse
    {
        $response = $service->handle($request->validated('email'), $request->validated('password'));

        return response()->json(['token' => $response]);
    }
}
