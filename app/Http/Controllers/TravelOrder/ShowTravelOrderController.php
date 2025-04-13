<?php

namespace App\Http\Controllers\TravelOrder;

use App\Domain\TravelOrder\Services\ShowTravelOrderService;
use App\Http\Controllers\Controller;
use App\Models\TravelOrder;
use Illuminate\Http\JsonResponse;

class ShowTravelOrderController extends Controller
{
    public function __invoke(ShowTravelOrderService $service, TravelOrder $travelOrder): JsonResponse
    {
        $resource = $service->handle($travelOrder->id);

        return response()->json($resource)->setStatusCode(JsonResponse::HTTP_OK);
    }
}
