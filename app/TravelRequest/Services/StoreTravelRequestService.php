<?php

namespace App\TravelRequest\Services;

use App\Models\TravelRequest;
use App\TravelRequest\DTOs\TravelRequestDTO;
use App\TravelRequest\Repositories\TravelRequestRepository;

class StoreTravelRequestService
{
    public function __construct(private readonly TravelRequestRepository $repository)
    {
    }

    public function handle(TravelRequestDTO $travelRequestDTO): TravelRequest
    {
        return $this->repository->store($travelRequestDTO->toArray());
    }
}
