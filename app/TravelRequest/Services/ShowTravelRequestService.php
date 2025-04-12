<?php

namespace App\TravelRequest\Services;

use App\Http\Resources\TravelRequestResource;
use App\TravelRequest\Repositories\TravelRequestRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowTravelRequestService
{
    public function __construct(private readonly TravelRequestRepository $repository) {}

    public function handle(int $id): TravelRequestResource|JsonResource
    {
        return $this->repository->findOrFail($id)->toResource();
    }
}
