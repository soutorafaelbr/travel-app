<?php

namespace App\TravelRequest\Services;

use App\TravelRequest\Repositories\TravelRequestRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetTravelRequestService
{
    public function __construct(private readonly TravelRequestRepository $repository)
    {
    }

    public function handle(): JsonResponse|ResourceCollection
    {
        return $this->repository->get()->toResourceCollection();
    }
}
