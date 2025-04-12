<?php

namespace App\Domain\TravelRequest\Services;

use App\Domain\TravelRequest\Repositories\TravelRequestRepository;
use App\Http\Resources\TravelRequestResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowTravelRequestService
{
    public function __construct(private readonly TravelRequestRepository $repository) {}

    public function handle(int $id): TravelRequestResource|JsonResource
    {
        return $this->repository->findOrFail($id)->toResource();
    }
}
