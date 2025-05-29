<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;
    
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $provider = User::where('id', '!=', $user->id)->inRandomOrder()->first();
        $service = Service::inRandomOrder()->first();
        
        return [
            'user_id' => $user->id,
            'provider_id' => $provider->id,
            'service_id' => $service->id,
            'date' => $this->faker->dateTimeBetween('+1 days', '+1 month')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
        ];
    }
}