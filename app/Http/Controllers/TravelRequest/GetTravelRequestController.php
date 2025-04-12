<?php

namespace App\Http\Controllers\TravelRequest;

use App\Domain\TravelRequest\Services\GetTravelRequestService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetTravelRequestController extends Controller
{
    public function __invoke(Request $request, GetTravelRequestService $service): JsonResponse
    {
        $resourceCollection = $service->handle($request->user()->id);

        return response()->json($resourceCollection);
    }
}
