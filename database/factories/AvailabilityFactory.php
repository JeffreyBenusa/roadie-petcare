<?php

namespace Database\Factories;

use App\Models\Availability;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AvailabilityFactory extends Factory
{
    protected $model = Availability::class;
    
    public function definition(): array
    {
        return [
            'provider_id' => User::factory(),
            'date' => $this->faker->dateTimeBetween('+0 days', '+1 month')->format('Y-m-d'),
        ];
    }
}