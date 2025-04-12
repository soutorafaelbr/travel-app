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
}
