<?php

namespace Database\Factories;

use App\Domain\TravelRequest\Enums\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TravelRequest>
 */
class TravelRequestFactory extends Factory
{
    public function definition(): array
    {
        return [
            'applicant_name' => $this->faker->name(),
            'status' => Status::Requested->value,
            'destination' => $this->faker->city(),
            'departure_date' => now()->addDay(),
            'return_date' => now()->addWeek(),
        ];
    }
}
