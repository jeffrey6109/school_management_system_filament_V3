<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Enums\Race;
use App\Enums\Religion;
use App\Enums\Status;
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
            'name' => fake()->Name(),
            'student_id' => 'STD-'.strtoupper(uniqid()),
            'date_of_birth' => fake()->date(),
            'gender' => fake()->randomElement(Gender::getValues()),
            'nationality' => 'Malaysian',
            'Religion' => fake()->randomElement(Religion::getValues()),
            'Race' => fake()->randomElement(Race::getValues()),
            'status' => fake()->randomElement(Status::getValues()),
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
