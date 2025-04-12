<?php

namespace App\Http\Controllers\TravelRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTravelRequest;
use App\TravelRequest\DTOs\TravelRequestDTO;
use App\TravelRequest\Services\StoreTravelRequestService;
use Illuminate\Http\JsonResponse;

class StoreTravelRequestController extends Controller
{
    public function __invoke(StoreTravelRequest $request, StoreTravelRequestService $service): JsonResponse
    {
        $response = $service->handle(TravelRequestDTO::fromRequest($request));

        return response()->json($response, JsonResponse::HTTP_CREATED);
    }
}
