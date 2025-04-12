<?php

namespace App\Http\Controllers\TravelRequest;

use App\Domain\TravelRequest\DTOs\UpdateTravelRequestStatusDTO;
use App\Domain\TravelRequest\Services\UpdateTravelRequestStatusService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTravelRequestStatusRequest;
use App\Models\TravelRequest;
use Illuminate\Http\JsonResponse;

class UpdateStatusTravelRequestController extends Controller
{
    public function __invoke(
        UpdateTravelRequestStatusRequest $request,
        TravelRequest $travelRequest,
        UpdateTravelRequestStatusService $service
    ): JsonResponse
    {
        $service->handle(UpdateTravelRequestStatusDTO::fromRequest($request));

        return response()->json()->setStatusCode(JsonResponse::HTTP_NO_CONTENT);
    }
}
