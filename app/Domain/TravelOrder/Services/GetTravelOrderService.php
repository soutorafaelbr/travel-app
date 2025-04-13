<?php

namespace App\Domain\TravelOrder\Services;

use App\Domain\TravelOrder\Repositories\TravelOrderRepository;
use App\Domain\TravelOrder\DTOs\GetTravelOrderDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetTravelOrderService
{
    public function __construct(private readonly TravelOrderRepository $repository) {}

    public function handle(GetTravelOrderDTO $DTO): JsonResponse|ResourceCollection
    {
        return $this->repository->getByUserId($DTO)->toResourceCollection();
    }
}
