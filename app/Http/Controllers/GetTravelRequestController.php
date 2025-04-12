<?php

namespace App\Http\Controllers;

use App\TravelRequest\Services\GetTravelRequestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetTravelRequestController extends Controller
{
    public function __invoke(Request $request, GetTravelRequestService $service): JsonResponse
    {
        $resourceCollection = $service->handle();

        return response()->json($resourceCollection);
    }
}
