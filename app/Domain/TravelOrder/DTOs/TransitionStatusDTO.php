<?php

namespace App\Domain\TravelOrder\DTOs;

use App\Domain\TravelOrder\Enums\Status;

class TransitionStatusDTO
{
    public function __construct(
        public readonly Status $from,
        public readonly Status $to
    ) {}
}
