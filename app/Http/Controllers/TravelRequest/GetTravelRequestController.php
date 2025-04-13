<?php

namespace App\Http\Controllers\TravelRequest;

use App\Domain\TravelRequest\DTOs\GetTravelRequestDTO;
use App\Domain\TravelRequest\Services\GetTravelRequestService;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetTravelRequest;
use Illuminate\Http\JsonResponse;

class GetTravelRequestController extends Controller
{
    public function __invoke(GetTravelRequest $request, GetTravelRequestService $service): JsonResponse
    {
        $resourceCollection = $service->handle(GetTravelRequestDTO::fromRequest($request));

        return response()->json($resourceCollection);
    }
}
