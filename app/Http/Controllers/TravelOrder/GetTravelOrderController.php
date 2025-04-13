<?php

namespace App\Http\Controllers\TravelOrder;

use App\Domain\TravelOrder\DTOs\GetTravelOrderDTO;
use App\Domain\TravelOrder\Services\GetTravelOrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetTravelOrderRequest;
use Illuminate\Http\JsonResponse;

class GetTravelOrderController extends Controller
{
    public function __invoke(GetTravelOrderRequest $request, GetTravelOrderService $service): JsonResponse
    {
        $resourceCollection = $service->handle(GetTravelOrderDTO::fromRequest($request));

        return response()->json($resourceCollection);
    }
}
