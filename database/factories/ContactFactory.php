<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'first_name' =>fake()->firstName(),
        'last_name' =>fake()->lastName() ,
        'email' =>fake()->unique()->email(),
        'phone_number' =>fake()->phoneNumber(),
        'address' =>fake()->streetAddress(),
        'birth_date' =>fake()->date(),

        ];
    }
}
