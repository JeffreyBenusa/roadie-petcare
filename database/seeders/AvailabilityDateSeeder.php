<?php

namespace Database\Seeders;

use App\Models\AvailabilityDate;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AvailabilityDateSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $services = ServiceType::all();
        
        foreach ($users as $user) {
            $offeredServices = $services->random(rand(1, $services->count()));
            
            foreach ($offeredServices as $service) {
                foreach (range(0, 13) as $offset) {
                    AvailabilityDate::factory()->create([
                        'user_id' => $user->id,
                        'service_type_id' => $service->id,
                        'date' => now()->addDays($offset),
                        'max_pets' => rand(1, 5),
                        'booked_pets' => rand(0, 2),
                    ]);
                }
            }
        }
    }
}
