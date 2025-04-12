<?php

namespace App\Http\Controllers;

use App\Domain\TravelRequest\DTOs\UpdateTravelRequestStatusDTO;
use App\Domain\TravelRequest\Services\UpdateTravelRequestStatusService;
use App\Http\Requests\UpdateTravelRequestStatusRequest;
use Illuminate\Http\JsonResponse;

class UpdateStatusTravelRequestController extends Controller
{
    public function __invoke(UpdateTravelRequestStatusRequest $request, int $id, UpdateTravelRequestStatusService $service): JsonResponse
    {
        $service->handle(UpdateTravelRequestStatusDTO::fromRequest($request));

        return response()->json()->setStatusCode(JsonResponse::HTTP_NO_CONTENT);
    }
}
