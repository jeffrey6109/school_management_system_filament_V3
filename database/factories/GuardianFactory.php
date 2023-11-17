<?php

namespace Database\Factories;

use App\Enums\RelationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guardian>
 */
class GuardianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'contact_number' => fake()->phoneNumber(),
            'ic_no' => uniqid(),
            'relation_type' => fake()->randomElement(RelationType::getValues()),
        ];
    }
}
