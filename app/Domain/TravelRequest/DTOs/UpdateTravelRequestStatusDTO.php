<?php

namespace App\Domain\TravelRequest\DTOs;

use App\Domain\TravelRequest\Enums\Status;
use App\Http\Requests\UpdateTravelRequestStatusRequest;

class UpdateTravelRequestStatusDTO
{
    public function __construct(
        public readonly int $id,
        public readonly Status $status,
    ) {}

    public static function fromRequest(UpdateTravelRequestStatusRequest $request): self
    {
        return new self(
            id: $request->route('travelRequest')->id,
            status: Status::from($request->validated('status')),
        );
    }

    public function toArray(): array
    {
        return [
            'id'              => $this->id,
            'status'          => $this->status,
        ];
    }
}
