<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    protected $model = Listing::class;
    
    public function definition(): array
    {
        return [
            'publisher_id' => User::factory(),
            'service_id' => Service::inRandomOrder()->first(),
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ];
    }
}