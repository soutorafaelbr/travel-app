<?php

namespace App\Http\Controllers;

use App\Domain\TravelRequest\Services\ShowTravelRequestService;
use Illuminate\Http\JsonResponse;

class ShowTravelRequestController extends Controller
{
    public function __invoke(int $id, ShowTravelRequestService $service): JsonResponse
    {
        $resource = $service->handle($id);
        return response()->json($resource)->setStatusCode(JsonResponse::HTTP_OK);
    }
}
