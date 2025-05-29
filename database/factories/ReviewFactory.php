<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'rating' => $this->faker->randomFloat(1, 3,5),
            'listing_id' => Listing::factory(),
            'provider_id' => User::inRandomOrder()->first()
        ];
    }
}
