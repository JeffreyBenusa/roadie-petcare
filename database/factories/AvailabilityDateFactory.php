<?php

namespace Database\Factories;

use App\Models\AvailabilityDate;
use App\Models\User;
use App\Models\ServiceType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AvailabilityDateFactory extends Factory
{
    protected $model = AvailabilityDate::class;
    
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'service_type_id' => ServiceType::factory(),
            'date' => Carbon::today()->addDays(rand(0, 30)),
            'max_pets' => $this->faker->numberBetween(1, 5),
            'booked_pets' => 0,
        ];
    }
}