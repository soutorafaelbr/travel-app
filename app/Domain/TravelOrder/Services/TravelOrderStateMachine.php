<?php

namespace App\Domain\TravelOrder\Services;

use App\Domain\TravelOrder\DTOs\TransitionStatusDTO;
use Illuminate\Validation\ValidationException;

class TravelOrderStateMachine
{
    public function handle(TransitionStatusDTO $DTO)
    {
        if (! $DTO->from->canTransitionTo($DTO->to)) {
            throw ValidationException::withMessages([
                'status' => 'Invalid status transition from '.$DTO->from->value.' to '.$DTO->to->value,
            ]);
        }
    }
}
