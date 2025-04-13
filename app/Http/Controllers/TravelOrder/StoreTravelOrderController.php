<?php

namespace App\Http\Controllers\TravelOrder;

use App\Domain\TravelOrder\DTOs\TravelOrderDTO;
use App\Domain\TravelOrder\Services\StoreTravelOrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTravelOrderRequest;
use Illuminate\Http\JsonResponse;

class StoreTravelOrderController extends Controller
{
    public function __invoke(StoreTravelOrderRequest $request, StoreTravelOrderService $service): JsonResponse
    {
        $response = $service->handle(TravelOrderDTO::fromRequest($request));

        return response()->json($response, JsonResponse::HTTP_CREATED);
    }
}
