<?php

namespace App\Domain\TravelOrder\Services;

use App\Domain\TravelOrder\Repositories\TravelOrderRepository;
use App\Http\Resources\TravelOrderResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowTravelOrderService
{
    public function __construct(private readonly TravelOrderRepository $repository) {}

    public function handle(int $id): TravelOrderResource|JsonResource
    {
        return $this->repository->findOrFail($id)->toResource();
    }
}
