<?php

namespace App\TravelRequest\DTOs;

use App\Http\Requests\StoreTravelRequest;
use Carbon\Carbon;

class TravelRequestDTO
{
    public function __construct(
        public readonly string $destination,
        public readonly Carbon $departureDate,
        public readonly Carbon $returnDate,
        public readonly string $applicantName,
    ) {}

    public static function fromRequest(StoreTravelRequest $request): self
    {
        return new self(
            destination: $request->validated('destination'),
            departureDate: Carbon::parse($request->validated('departure_date')),
            returnDate: Carbon::parse($request->validated('return_date')),
            applicantName: $request->validated('applicant_name'),
        );
    }

    public function toArray(): array
    {
        return [
            'destination'     => $this->destination,
            'departure_date'  => $this->departureDate->toDateTimeString(),
            'return_date'     => $this->returnDate->toDateTimeString(),
            'applicant_name'  => $this->applicantName,
        ];
    }
}
