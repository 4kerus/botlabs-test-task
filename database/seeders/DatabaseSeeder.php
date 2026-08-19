<?php

namespace Database\Seeders;

use App\Models\Call;
use App\Models\Lead;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        $managers = Manager::factory()->count(5)->create();

        Lead::factory()
            ->count(30)
            ->create()
            ->each(function (Lead $lead) use ($managers) {
                Call::factory()
                    ->for($lead, 'lead')
                    ->for($managers->random(), 'manager')
                    ->count(fake()->numberBetween(0, 5))
                    ->create();
            });
    }
}
