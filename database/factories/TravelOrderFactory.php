<?php

namespace Database\Factories;

use App\Domain\TravelOrder\Enums\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TravelOrder>
 */
class TravelOrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => fn () => User::factory()->create()->id,
            'applicant_name' => $this->faker->name(),
            'status' => Status::Requested->value,
            'destination' => 'São Paulo',
            'departure_date' => now()->addDay(),
            'return_date' => now()->addWeek(),
        ];
    }
}
