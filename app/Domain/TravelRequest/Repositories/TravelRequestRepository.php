<?php

namespace App\Domain\TravelRequest\Repositories;

use App\Domain\TravelRequest\DTOs\GetTravelRequestDTO;
use App\Models\TravelRequest;
use Illuminate\Database\Eloquent\Collection;

class TravelRequestRepository
{
    public function __construct(private readonly TravelRequest $model) {}

    public function store(array $data): TravelRequest
    {
        return $this->model->create($data);
    }

    public function update($id, $data): bool
    {
        return $this->model->whereId($id)->update($data);
    }

    public function findOrFail(int $id): ?TravelRequest
    {
        return $this->model->findOrFail($id);
    }

    public function getByUserId(GetTravelRequestDTO $DTO): Collection
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
