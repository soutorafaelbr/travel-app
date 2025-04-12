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
}
