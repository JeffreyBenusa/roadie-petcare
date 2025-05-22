<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\ServiceType;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\AvailabilityDateSeeder;
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
            ServiceType::firstOrCreate(['name' => $type['name']], $type);
        }
        
        // Create service providers with their availabilities
        $users = User::factory()
            ->count(10)
            ->create();
        
        $jobs = Job::factory()
            ->count(20)
            ->create([
                'publisher_id' => $admin->id,
            ]);
        
        
        foreach ($jobs as $job) {
            Review::factory([
                'job_id' => $job->id,
                'provider_id' => $users->random()->id,
            ])->create();
        }
        
        
        // Call separate Seeders
        $this->call([
            AvailabilityDateSeeder::class,
        ]);
    }
}
