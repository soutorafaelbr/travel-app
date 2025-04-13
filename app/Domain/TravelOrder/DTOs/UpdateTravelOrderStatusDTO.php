<?php

namespace App\Domain\TravelOrder\DTOs;

use App\Domain\TravelOrder\Enums\Status;
use App\Http\Requests\UpdateTravelOrderStatusRequest;

class UpdateTravelOrderStatusDTO
{
    public function __construct(
        public readonly int $id,
        public readonly Status $status,
    ) {}

    public static function fromRequest(UpdateTravelOrderStatusRequest $request): self
    {
        return new self(
            id: $request->route('travelOrder')->id,
            status: Status::from($request->validated('status')),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
        ];
    }
}
