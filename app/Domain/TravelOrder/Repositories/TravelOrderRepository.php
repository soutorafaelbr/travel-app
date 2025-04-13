<?php

namespace App\Domain\TravelOrder\Repositories;

use App\Domain\TravelOrder\DTOs\GetTravelOrderDTO;
use App\Models\TravelOrder;
use Illuminate\Database\Eloquent\Collection;

class TravelOrderRepository
{
    public function __construct(private readonly TravelOrder $model) {}

    public function store(array $data): TravelOrder
    {
        return $this->model->create($data);
    }

    public function update($id, $data): bool
    {
        return $this->model->whereId($id)->update($data);
    }

    public function findOrFail(int $id): ?TravelOrder
    {
        return $this->model->findOrFail($id);
    }

    public function getByUserId(GetTravelOrderDTO $DTO): Collection
    {
        return $this->model->where('user_id', $DTO->userId)
            ->when($DTO->status, fn ($q) => $q->where('status', $DTO->status))
            ->when($DTO->destination, fn ($q) => $q->where('destination', $DTO->destination))
            ->when(
                $DTO->from && $DTO->to,
                fn ($q) => $q->where('departure_date', '>=', $DTO->from)
                    ->where('departure_date', '<=', $DTO->to)
            )
            ->get();
    }
}
