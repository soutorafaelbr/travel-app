<?php

namespace App\Http\Controllers\Authentication;

use App\Domain\Authentication\Services\LogoutService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request, LogoutService $service)
    {
        $service->handle($request->user());

        return response()->json(['message' => 'Logged out successfully']);
    }
}
