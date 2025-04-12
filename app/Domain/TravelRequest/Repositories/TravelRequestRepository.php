<?php

namespace App\Domain\TravelRequest\Repositories;

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

    public function getByUserId(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->get();
    }
}
