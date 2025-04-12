<?php

namespace App\Domain\TravelRequest\Services;

use App\Domain\TravelRequest\DTOs\TravelRequestDTO;
use App\Domain\TravelRequest\Repositories\TravelRequestRepository;
use App\Http\Resources\TravelRequestResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreTravelRequestService
{
    public function __construct(private readonly TravelRequestRepository $repository) {}

    public function handle(TravelRequestDTO $travelRequestDTO): TravelRequestResource|JsonResource
    {
        return $this->repository->store($travelRequestDTO->toArray())->toResource();
    }
}
