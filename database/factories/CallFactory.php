<?php

namespace Database\Factories;

use App\Enums\CallResult;
use App\Models\Call;
use App\Models\Lead;
use App\Models\Manager;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Call>
 */
class CallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lead_id' => Lead::factory(),
            'manager_id' => Manager::factory(),
            'duration' => fake()->numberBetween(0, 600),
            'result' => fake()->randomElement(CallResult::cases()),
        ];
    }
}
