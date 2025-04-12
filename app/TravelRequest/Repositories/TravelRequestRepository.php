<?php

namespace App\TravelRequest\Repositories;

use App\Models\TravelRequest;

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
}
