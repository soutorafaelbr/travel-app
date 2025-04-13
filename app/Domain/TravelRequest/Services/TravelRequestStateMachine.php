<?php

namespace App\Domain\TravelRequest\Services;

use App\Domain\TravelRequest\DTOs\TransitionStatusDTO;
use Illuminate\Validation\ValidationException;

class TravelRequestStateMachine
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
