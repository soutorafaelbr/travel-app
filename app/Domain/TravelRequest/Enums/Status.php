<?php

namespace App\Domain\TravelRequest\Enums;

enum Status: string
{
    case Requested = 'requested';
    case Approved = 'approved';
    case Canceled = 'canceled';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function canTransitionTo(self $newStatus): bool
    {
        return match ($this) {
            self::Requested => in_array($newStatus, [self::Approved, self::Canceled]),
            self::Approved => false,
            self::Canceled => false,
        };
    }
}
