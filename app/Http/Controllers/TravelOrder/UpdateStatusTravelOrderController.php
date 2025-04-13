<?php

namespace App\Http\Controllers\TravelOrder;

use App\Domain\TravelOrder\DTOs\UpdateTravelOrderStatusDTO;
use App\Domain\TravelOrder\Services\UpdateTravelOrderStatusService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTravelOrderStatusRequest;
use App\Models\TravelOrder;
use Illuminate\Http\JsonResponse;

class UpdateStatusTravelOrderController extends Controller
{
    public function __invoke(
        UpdateTravelOrderStatusRequest $request,
        TravelOrder $travelOrder,
        UpdateTravelOrderStatusService $service
    ): JsonResponse {
        $service->handle(UpdateTravelOrderStatusDTO::fromRequest($request));

        return response()->json()->setStatusCode(JsonResponse::HTTP_NO_CONTENT);
    }
}
