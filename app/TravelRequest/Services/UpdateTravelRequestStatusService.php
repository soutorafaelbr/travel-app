<?php

namespace App\TravelRequest\Services;

use App\TravelRequest\DTOs\UpdateTravelRequestStatusDTO;
use App\TravelRequest\Repositories\TravelRequestRepository;

class UpdateTravelRequestStatusService
{
    public function __construct(private readonly TravelRequestRepository $repository) {}

    public function handle(UpdateTravelRequestStatusDTO $DTO): void
    {
        $this->repository->update($DTO->id, ['status' => $DTO->status]);
    }
}
