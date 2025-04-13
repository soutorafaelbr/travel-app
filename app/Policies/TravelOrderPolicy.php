<?php

namespace App\Policies;

use App\Models\TravelOrder;
use App\Models\User;

class TravelOrderPolicy
{
    public function view(User $user, TravelOrder $travelOrder): bool
    {
        return $user->id === $travelOrder->user_id;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, TravelOrder $travelOrder): bool
    {
        return $user->id !== $travelOrder->user_id;
    }
}
