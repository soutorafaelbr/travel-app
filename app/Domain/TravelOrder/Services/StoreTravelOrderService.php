<?php

namespace App\Domain\TravelOrder\Services;

use App\Domain\TravelOrder\DTOs\TravelOrderDTO;
use App\Domain\TravelOrder\Repositories\TravelOrderRepository;
use App\Http\Resources\TravelOrderResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreTravelOrderService
{
    public function __construct(private readonly TravelOrderRepository $repository) {}

    public function handle(TravelOrderDTO $travelOrderDTO): TravelOrderResource|JsonResource
    {
        return $this->repository->store($travelOrderDTO->toArray())->toResource();
    }
}
