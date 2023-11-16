<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'student_id' => 'STD-'.strtoupper(uniqid()),
            'date_of_birth' => fake()->date(),
            'gender' => 'male',
            'nationality' => 'Malaysian',
            'Religion' => 'christian',
            'Race' => 'chinese',
            'status' => 'AS',
            'ic_no' => uniqid(12),
            'home_phone' => fake()->phoneNumber(),
            'mobile_phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->email(),
            'address_1' => fake()->streetAddress(),
            'address_2' => fake()->country(),
            'standard_id' => 1,
        ];
    }
}
