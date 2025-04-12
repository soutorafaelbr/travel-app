<?php

namespace App\Domain\TravelRequest\Services;

use App\Domain\TravelRequest\DTOs\UpdateTravelRequestStatusDTO;
use App\Domain\TravelRequest\Repositories\TravelRequestRepository;

class UpdateTravelRequestStatusService
{
    public function __construct(private readonly TravelRequestRepository $repository) {}

    public function handle(UpdateTravelRequestStatusDTO $DTO): void
    {
        $this->repository->update($DTO->id, ['status' => $DTO->status]);
    }
}
