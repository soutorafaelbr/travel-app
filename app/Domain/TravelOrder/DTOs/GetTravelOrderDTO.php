<?php

namespace App\Domain\TravelOrder\DTOs;

use App\Http\Requests\GetTravelOrderRequest;

class GetTravelOrderDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly ?string $status = null,
        public readonly ?string $destination = null,
        public readonly ?string $from = null,
        public readonly ?string $to = null,
    ) {}

    public static function fromRequest(GetTravelOrderRequest $request): self
    {
        return new self(
            userId: $request->user()->id,
            status: $request->validated('status'),
            destination: $request->validated('destination'),
            from: $request->validated('from'),
            to: $request->validated('to'),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->userId,
            'status' => $this->status,
            'destination' => $this->destination,
            'from' => $this->from,
            'to' => $this->to,
        ];
    }
}
