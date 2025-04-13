<?php

namespace App\Domain\TravelRequest\Services;

use App\Domain\TravelRequest\DTOs\GetTravelRequestDTO;
use App\Domain\TravelRequest\Repositories\TravelRequestRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetTravelRequestService
{
    public function __construct(private readonly TravelRequestRepository $repository) {}

    public function handle(GetTravelRequestDTO $DTO): JsonResponse|ResourceCollection
    {
        return $this->repository->getByUserId($DTO)->toResourceCollection();
    }
}
