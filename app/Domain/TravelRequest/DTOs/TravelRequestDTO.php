<?php

namespace App\Domain\TravelRequest\DTOs;

use App\Http\Requests\StoreTravelRequest;
use Carbon\Carbon;

class TravelRequestDTO
{
    public function __construct(
        public readonly string $destination,
        public readonly Carbon $departureDate,
        public readonly Carbon $returnDate,
        public readonly string $applicantName,
        public readonly string $status,
        public readonly int $userId
    ) {}

    public static function fromRequest(StoreTravelRequest $request): self
    {
        return new self(
            destination: $request->validated('destination'),
            departureDate: Carbon::parse($request->validated('departure_date')),
            returnDate: Carbon::parse($request->validated('return_date')),
            applicantName: $request->validated('applicant_name'),
            status: $request->validated('status'),
            userId: (int) $request->user()->id,
        );
    }

    public function toArray(): array
    {
        return [
            'destination'     => $this->destination,
            'departure_date'  => $this->departureDate->toDate(),
            'return_date'     => $this->returnDate->toDate(),
            'applicant_name'  => $this->applicantName,
            'status'          => $this->status,
            'user_id'         => $this->userId,
        ];
    }
}
