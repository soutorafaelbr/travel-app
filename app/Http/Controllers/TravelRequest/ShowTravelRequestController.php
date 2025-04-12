<?php

namespace App\Http\Controllers\TravelRequest;

use App\Domain\TravelRequest\Services\ShowTravelRequestService;
use App\Http\Controllers\Controller;
use App\Models\TravelRequest;
use Illuminate\Http\JsonResponse;

class ShowTravelRequestController extends Controller
{
    public function __invoke(ShowTravelRequestService $service, TravelRequest $travelRequest): JsonResponse
    {
        $resource = $service->handle($travelRequest->id);
        return response()->json($resource)->setStatusCode(JsonResponse::HTTP_OK);
    }
}
