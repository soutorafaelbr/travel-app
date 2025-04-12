<?php

namespace App\Policies;

use App\Models\TravelRequest;
use App\Models\User;

class TravelRequestPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, TravelRequest $travelRequest): bool
    {
        return $user->id === $travelRequest->user_id;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, TravelRequest $travelRequest): bool
    {
        return $user->id !== $travelRequest->user_id;
    }

    public function delete(User $user, TravelRequest $travelRequest): bool
    {
        return false;
    }

    public function restore(User $user, TravelRequest $travelRequest): bool
    {
        return false;
    }

    public function forceDelete(User $user, TravelRequest $travelRequest): bool
    {
        return false;
    }
}
