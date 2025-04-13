<?php

namespace App\Domain\TravelRequest\DTOs;

use App\Domain\TravelRequest\Enums\Status;

class TransitionStatusDTO
{
    public function __construct(
        public readonly Status $from,
        public readonly Status $to
    ) {}
}
