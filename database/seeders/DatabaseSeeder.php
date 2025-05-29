<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Service;
use App\Models\Listing;
use App\Models\User;
use App\Models\Booking;
use App\Models\Availability;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create hard-coded admin user
        $admin = User::factory()->create([
            'name' => 'Jeff',
            'email' => 'jeff.benusa@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('apples'),
        ]);
        
        // Adding Service Types
        $types = [
            ['name' => 'Dog Walking', 'body' => 'Daily or occasional dog walks.'],
            ['name' => 'Pet Sitting', 'body' => 'In-home pet sitting while you are away.'],
            ['name' => 'Boarding', 'body' => 'Overnight care for your pet in a sitter\'s home.'],
            ['name' => 'Drop-In Visits', 'body' => 'Short visits to check on your pet.'],
            ['name' => 'Grooming', 'body' => 'Bathing, brushing, and grooming services.'],
            ['name' => 'Training', 'body' => 'Pet training sessions.'],
        ];
        
        foreach ($types as $type) {
            Service::firstOrCreate(['name' => $type['name']], $type);
        }
        
        // Create service providers with their availabilities
        User::factory()->count(10)->create();
        
        $users = User::all();
        
        $listings = Listing::factory(10)
            ->create([
                'publisher_id' => $admin->id,
            ]);
        
        foreach ($listings as $listing) {
            Review::factory([
                'listing_id' => $listing->id,
                'provider_id' => $users->random()->id,
            ])->create();
        }
        
        Booking::factory()->count(10)->create();
        
    }
}
