<?php

namespace App\TravelRequest\Services;

use App\Http\Resources\TravelRequestResource;
use App\TravelRequest\DTOs\TravelRequestDTO;
use App\TravelRequest\Repositories\TravelRequestRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreTravelRequestService
{
    public function __construct(private readonly TravelRequestRepository $repository) {}

    public function handle(TravelRequestDTO $travelRequestDTO): TravelRequestResource|JsonResource
    {
        return $this->repository->store($travelRequestDTO->toArray())->toResource();
    }
}
