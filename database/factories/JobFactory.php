<?php

namespace Database\Factories;

use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Provider\en_US\Address;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $service_type = ServiceType::query()->inRandomOrder()->first();
        
        return [
            'title' => fake()->jobTitle(),
            'body' => fake()->sentence(),
            'service_type_id' => $service_type,
            'publisher_id' => User::find( random_int(1, 11))
        ];
    }
}
