<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        User::factory()->withPersonalTeam()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            PropertySeeder::class,
            RentalFacilitiesSeeder::class,
            FacilitiesSeeder::class,
            RentalServiceSeeder::class,
            StatusSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
